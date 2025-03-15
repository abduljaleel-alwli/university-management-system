<?php

namespace App\Livewire;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentShow extends Component
{
    public $student_id;
    public $student;
    public $studen_full_name;
    public $paymentId;
    public $receipt_number;
    public $amount;
    public $currency = 'IQD';
    public $payment_date;
    public $notes;

    protected $rules = [
        'amount' => 'required|numeric|min:0',
        'currency' => 'required|in:IQD,USD',
        'payment_date' => 'required|date',
        'notes' => 'nullable|string',
    ];

    public function mount($paymentId)
    {
        $payment = Payment::findOrFail($this->paymentId);
        $student = $payment->student;

        // التحقق من صلاحية المستخدم
        if (Auth::user()->hasRole('admin')) {
            if (Auth::user()->department_id !== $payment->department_id) {
                abort(403, 'غير مسموح لك بعرض البيانات.');
            }
        } elseif (!Auth::user()->hasRole('super-admin')) {
            abort(403, 'غير مسموح لك.');
        }

        $this->student = $student;
        $this->studen_full_name = $student->first_name . ' '. $student->father_name . ' ' . $student->grandfather_name . ' ' . $student->last_name;
        $this->paymentId = $payment->id;
        $this->receipt_number = $payment->receipt_number;
        $this->amount = $payment->amount;
        $this->currency = $payment->currency;
        $this->payment_date = $payment->payment_date;
        $this->notes = $payment->notes;
    }

    public function updatePayment()
    {
        $this->validate();

        // التحقق من صلاحية المستخدم
        if (!Auth::user()->hasRole('admin')) {
            session()->flash('error', 'ليس لديك صلاحية لتعديل الدفعة.');
            return;
        }

        $payment = Payment::findOrFail($this->paymentId);

        if (Auth::user()->department_id !== $payment->department_id) {
            session()->flash('error', 'لا يمكنك تعديل هذه الدفعة.');
            return;
        }

        $payment->update([
            // 'receipt_number' => $this->receipt_number,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'payment_date' => $this->payment_date,
            'notes' => $this->notes,
            'editor_id' => Auth::id(),
        ]);

        session()->flash('message', 'تم تعديل الدفعة بنجاح.');
    }

    public function render()
    {
        $payments = Payment::where('student_id', $this->student_id)->latest()->get();
        return view('livewire.payment-show', compact('payments'));
    }
}
