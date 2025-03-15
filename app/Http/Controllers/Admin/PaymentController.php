<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return view('panel.admin.payment.index');
    }

    public function show($id)
    {
        // $student = Payment::where('id', $id)->first()->student;
        // $student_name = $student->first_name . ' '. $student->father_name . ' ' . $student->grandfather_name . ' ' . $student->last_name;
        // return view('panel.admin.payment.show', ['payment_id' => $id, 'student_name' => $student_name]);
        return view('panel.admin.payment.show', ['payment_id' => $id]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|in:IQD,USD',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // التحقق من أن المستخدم مسؤول (Admin) وفي نفس القسم
        if (!Auth::user()->hasRole('admin')) {
            return response()->json(['error' => 'ليس لديك صلاحية لإضافة دفعة.'], 403);
        }

        $student = Student::findOrFail($request->student_id);
        if (Auth::user()->department_id !== $student->department_id) {
            return response()->json(['error' => 'لا يمكنك إضافة دفعة لهذا الطالب.'], 403);
        }

        $payment = Payment::create([
            'student_id' => $request->student_id,
            'department_id' => Auth::user()->department_id,
            'author_id' => Auth::id(),
            'amount' => $request->amount,
            'currency' => $request->currency,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => 'تمت إضافة الدفعة بنجاح.',
            'payment' => $payment
        ]);
    }


    public function destroy($id)
    {
        // التحقق من أن المستخدم مسؤول (Admin)
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.payments.index')->with('error', 'ليس لديك صلاحية لحذف الدفعة.');
        }

        // العثور على الدفعة
        $payment = Payment::findOrFail($id);

        // التحقق من أن الدفعة تتعلق بنفس القسم
        if (Auth::user()->department_id !== $payment->student->department_id) {
            return redirect()->route('admin.payments.index')->with('error', 'لا يمكنك حذف دفعة لهذا الطالب.');
        }

        // حذف الدفعة
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('error', 'تم حذف الدفعة بنجاح.' );
    }


}
