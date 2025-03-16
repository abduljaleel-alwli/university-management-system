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
        return view('panel.super-admin.payment.show', ['payment_id' => $id]);
    }
}
