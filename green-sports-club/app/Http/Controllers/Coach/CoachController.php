<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function dashboard()
    {
        $coach = Auth::user()->coach;
        $sports = $coach->sports;
        $recentAttendances = Attendance::where('coach_id', $coach->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('coach.dashboard', compact('coach', 'sports', 'recentAttendances'));
    }
}