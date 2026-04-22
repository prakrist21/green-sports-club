<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::with('user', 'sports')->get();
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        $sports = Sport::all();
        return view('admin.coaches.create', compact('sports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'sports' => 'nullable|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'coach',
        ]);

        $coach = Coach::create([
            'user_id' => $user->id,
            'bio' => $request->bio,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
        ]);

        if ($request->sports) {
            $coach->sports()->attach($request->sports);
        }

        return redirect()->route('admin.coaches.index')
                        ->with('success', 'Coach created successfully!');
    }

    public function edit(Coach $coach)
    {
        $sports = Sport::all();
        $coachSports = $coach->sports->pluck('id')->toArray();
        return view('admin.coaches.edit', compact('coach', 'sports', 'coachSports'));
    }

    public function update(Request $request, Coach $coach)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $coach->user_id,
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'sports' => 'nullable|array',
        ]);

        $coach->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $coach->update([
            'bio' => $request->bio,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
        ]);

        $coach->sports()->sync($request->sports ?? []);

        return redirect()->route('admin.coaches.index')
                        ->with('success', 'Coach updated successfully!');
    }

    public function destroy(Coach $coach)
    {
        $coach->user->delete();
        return redirect()->route('admin.coaches.index')
                        ->with('success', 'Coach deleted successfully!');
    }

    public function show(Coach $coach)
    {
        return redirect()->route('admin.coaches.index');
    }
}