<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Coach;
use App\Models\Sport;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalCoaches = Coach::count();
        $totalSports = Sport::count();
        $pendingPayments = Payment::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalCoaches',
            'totalSports',
            'pendingPayments'
        ));
    }
}