<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user()->student;
        $sports = $student->sports;
        $recentAttendances = Attendance::where('student_id', $student->id)
                            ->latest()
                            ->take(5)
                            ->get();
        $pendingPayments = Payment::where('student_id', $student->id)
                            ->where('status', 'pending')
                            ->count();

        return view('student.dashboard', compact(
            'student',
            'sports',
            'recentAttendances',
            'pendingPayments'
        ));
    }
}