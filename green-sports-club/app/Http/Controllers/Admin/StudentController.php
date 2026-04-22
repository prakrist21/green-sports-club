<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'sports')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $sports = Sport::all();
        return view('admin.students.create', compact('sports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'sports' => 'nullable|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
            'enrolled_at' => now(),
        ]);

        if ($request->sports) {
            $student->sports()->attach($request->sports, ['enrolled_date' => now()]);
        }

        return redirect()->route('admin.students.index')
                        ->with('success', 'Student created successfully!');
    }

    public function edit(Student $student)
    {
        $sports = Sport::all();
        $studentSports = $student->sports->pluck('id')->toArray();
        return view('admin.students.edit', compact('student', 'sports', 'studentSports'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'dob' => 'nullable|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'sports' => 'nullable|array',
        ]);

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $student->update([
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $student->sports()->sync($request->sports ?? []);

        return redirect()->route('admin.students.index')
                        ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')
                        ->with('success', 'Student deleted successfully!');
    }

    public function show(Student $student)
    {
        return redirect()->route('admin.students.index');
    }
}