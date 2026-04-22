<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Sport;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student.user', 'fee.sport')
                    ->latest()
                    ->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::with('user', 'sports.coaches.user', 'sports.fees')->get();
        $fees = Fee::with('sport')->get();
        return view('admin.payments.create', compact('students', 'fees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_id' => 'required|exists:fees,id',
            'amount_paid' => 'required|numeric',
            'paid_at' => 'nullable|date',
            'status' => 'required|in:paid,pending,overdue',
        ]);

        Payment::create($request->all());

        return redirect()->route('admin.payments.index')
                        ->with('success', 'Payment recorded successfully!');
    }

    public function edit(Payment $payment)
    {
        $students = Student::with('user')->get();
        $fees = Fee::with('sport')->get();
        return view('admin.payments.edit', compact('payment', 'students', 'fees'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_id' => 'required|exists:fees,id',
            'amount_paid' => 'required|numeric',
            'paid_at' => 'nullable|date',
            'status' => 'required|in:paid,pending,overdue',
        ]);

        $payment->update($request->all());

        return redirect()->route('admin.payments.index')
                        ->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')
                        ->with('success', 'Payment deleted successfully!');
    }

    public function show(Payment $payment)
    {
        return redirect()->route('admin.payments.index');
    }
}