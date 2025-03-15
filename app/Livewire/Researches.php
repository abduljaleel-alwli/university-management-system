<?php

namespace App\Livewire;

use App\Models\Researches as ResearchesModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Researches extends Component
{
    use WithPagination;

    public $search = [
        'student_name' => '',
        'title' => '',
        'journal_name' => '',
        'publication_date' => '',
        'status' => '',
    ];

    public function searchResearches()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        $query = ResearchesModel::with(['student', 'department']);

        // تصفية الأبحاث حسب القسم إذا لم يكن المستخدم super-admin
        if (!$user->hasRole('super-admin')) {
            $query->where('department_id', $user->department_id);
        }

        if (!empty($this->search['student_name'])) {
            $query->whereHas('student', function ($q) {
                $q->whereRaw("CONCAT(first_name_en, ' ', father_name_en, ' ', grandfather_name_en, ' ', last_name_en) LIKE ? OR
                CONCAT(first_name_ar, ' ', father_name_ar, ' ', grandfather_name_ar, ' ', last_name_ar) LIKE ?",
                ["%{$this->search['student_name']}%", "%{$this->search['student_name']}%"]);
            });
        }

        if (!empty($this->search['title'])) {
            $query->where(function ($q) {
                $q->where('title_ar', 'like', '%' . $this->search['title'] . '%')
                  ->orWhere('title_en', 'like', '%' . $this->search['title'] . '%');
            });
        }

        if (!empty($this->search['journal_name'])) {
            $query->where('journal_name', 'like', '%' . $this->search['journal_name'] . '%');
        }

        if (!empty($this->search['publication_date'])) {
            $query->whereDate('publication_date', $this->search['publication_date']);
        }

        if (!empty($this->search['status'])) {
            $query->where('status', $this->search['status']);
        }

        $researches = $query->latest()->paginate(10);

        return view('livewire.researches', compact('researches'));
    }
}
