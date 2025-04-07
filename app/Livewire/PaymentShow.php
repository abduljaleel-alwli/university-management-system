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
        $payment = Payment::findOrFail($paymentId);
        $this->paymentId = $payment->id;

        $this->receipt_number = $payment->receipt_number;
        $this->amount = $payment->amount;
        $this->currency = $payment->currency;
        $this->payment_date = $payment->payment_date;
        $this->notes = $payment->notes;

        $this->student = $payment->student;

        if ($this->student) {
            $this->student_id = $this->student->id;
            $this->studen_full_name = $this->student->full_name ?? __('Deleted student');
        } else {
            $this->student_id = null;
            $this->studen_full_name = __('No associated student');
        }

        if (Auth::user()->hasRole('admin') && empty($this->student)) {
            return redirect()->route('admin.payments.index')->with('error', __('You don’t have permission.'));
        }

        // التحقق من صلاحية المستخدم
        if (Auth::user()->hasRole('admin') && $payment->department_id !== Auth::user()->department_id) {
            abort(403, __("You don’t have permission."));
        } elseif (!Auth::user()->hasRole('super-admin') && !Auth::user()->hasRole('admin')) {
            abort(403, __("You don’t have permission."));
        }
    }

    public function updatePayment()
    {
        $this->validate();

        // التحقق من صلاحية المستخدم
        if (!Auth::user()->hasRole('admin')) {
            session()->flash('error', __("You don’t have permission."));
            return;
        }

        $payment = Payment::findOrFail($this->paymentId);

        if (Auth::user()->department_id !== $payment->department_id) {
            session()->flash('error', __('You cannot edit this payment'));
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

        session()->flash('success', __('The payment has been successfully updated'));
    }

    public function render()
    {
        $payments = Payment::where('student_id', $this->student_id)->latest()->get();
        return view('livewire.payment-show', compact('payments'));
    }
}
