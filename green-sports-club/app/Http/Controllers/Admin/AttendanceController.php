<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Sport;
use App\Models\Coach;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student.user', 'sport', 'coach.user')
                        ->latest()
                        ->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    public function create()
    {
        $students = Student::with('user')->get();
        $sports = Sport::all();
        $coaches = Coach::with('user')->get();
        return view('admin.attendances.create', compact('students', 'sports', 'coaches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'sport_id' => 'required|exists:sports,id',
            'coach_id' => 'required|exists:coaches,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        Attendance::create($request->all());

        return redirect()->route('admin.attendances.index')
                        ->with('success', 'Attendance recorded successfully!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('admin.attendances.index')
                        ->with('success', 'Attendance deleted successfully!');
    }
}