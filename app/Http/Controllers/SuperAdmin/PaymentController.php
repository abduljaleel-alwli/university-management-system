<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('panel.super-admin.payment.index');
    }

    public function show($id)
    {
        // $student = Payment::where('id', $id)->first()->student;
        // $student_name = $student->first_name . ' '. $student->father_name . ' ' . $student->grandfather_name . ' ' . $student->last_name;
        // return view('panel.super-admin.payment.show', ['payment_id' => $id, 'student_name' => $student_name]);
        return view('panel.super-admin.payment.show', ['payment_id' => $id]);
    }
}
