<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class Payments extends Component
{
    use WithPagination;

    public $search = [
        'student_name' => '',
        'receipt_number' => '',
        'payment_date' => '',
        'currency' => '',
    ];

    public function searchPayments()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        $query = Payment::with(['student', 'author', 'editor']);

        // تصفية النتائج حسب القسم إذا لم يكن المستخدم super-admin
        if (!$user->hasRole('super-admin')) {
            $query->whereHas('student', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            });
        }

        if (!empty($this->search['student_name'])) {
            $query->whereHas('student', function ($q) {
                $q->whereRaw("CONCAT(first_name_en, ' ', father_name_en, ' ', grandfather_name_en, ' ', last_name_en) LIKE ? OR
                CONCAT(first_name_ar, ' ', father_name_ar, ' ', grandfather_name_ar, ' ', last_name_ar) LIKE ?",
                ["%{$this->search['student_name']}%", "%{$this->search['student_name']}%"]);
            });

        }

        if (!empty($this->search['receipt_number'])) {
            $query->where('receipt_number', 'like', '%' . $this->search['receipt_number'] . '%');
        }

        if (!empty($this->search['payment_date'])) {
            $query->whereDate('payment_date', $this->search['payment_date']);
        }

        if (!empty($this->search['currency'])) {
            $query->where('currency', $this->search['currency']);
        }

        $payments = $query->latest()->paginate(10);

        return view('livewire.payments', compact('payments'));
    }
}

