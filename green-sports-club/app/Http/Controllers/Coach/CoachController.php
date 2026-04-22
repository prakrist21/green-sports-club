<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function dashboard()
    {
        $coach = Auth::user()->coach;
        $sports = $coach->sports;
        $recentAttendances = Attendance::where('coach_id', $coach->id)
                            ->with('student.user', 'sport')
                            ->latest()
                            ->take(5)
                            ->get();

        $totalStudents = Student::whereHas('sports', function($q) use ($coach) {
            $q->whereIn('sports.id', $coach->sports->pluck('id'));
        })->count();

        return view('coach.dashboard', compact(
            'coach',
            'sports',
            'recentAttendances',
            'totalStudents'
        ));
    }
}