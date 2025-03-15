<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PostGraduationStep;
use Illuminate\Support\Facades\Auth;

class PostGraduationStepsIndex extends Component
{
    use WithPagination;

    public $search = [
        'name' => '',
        'discussion_date' => '',
        'committee_decision' => '',
        'clearance' => '',
        'sent_to_college' => '',
        'sent_to_ministry' => '',
        'archived' => '',
        'post_graduation_status' => '',
    ];

    public $filter = 'all'; // الفلترة العامة
    public $statuses;

    public function mount(){
        $this->statuses = [
            'graduate' => __('Graduate'),
            'fail' => __('Fail'),
            'pending_review' => __('Pending review')
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function searchData()
    {
        // إعادة ضبط الصفحة عند البحث لضمان عرض النتائج الصحيحة
        $this->resetPage();
    }

    public function getStudentsProperty()
    {
        $user = Auth::user();

        if ($user->hasRole('super-admin')) {
            $query = PostGraduationStep::with('student');
        } elseif ($user->hasRole('admin')) {
            $query = PostGraduationStep::whereHas('student', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            })->with('student');
        } else {
            abort(403, 'You have no permission.');
        }

        // تطبيق البحث على الطالب والبيانات الأخرى
        foreach ($this->search as $field => $value) {
            if (!empty($value)) {
                if ($field === 'name') {
                    $query->whereHas('student', function ($q) use ($value) {
                        $q->whereRaw("CONCAT(first_name_en, ' ', father_name_en, ' ', grandfather_name_en, ' ', last_name_en) LIKE ? OR
                        CONCAT(first_name_ar, ' ', father_name_ar, ' ', grandfather_name_ar, ' ', last_name_ar) LIKE ?",
                        ["%{$value}%", "%{$value}%"]);

                    });
                } elseif (in_array($field, ['discussion_date', 'committee_decision', 'clearance', 'sent_to_college', 'sent_to_ministry', 'archived', 'post_graduation_status'])) {
                    $query->where($field, 'like', "%{$value}%");
                }
            }
        }

        // تطبيق الفلتر
        if ($this->filter !== 'all') {
            $query->where('post_graduation_status', $this->filter);
        }

        return $query->latest()->paginate(10);
    }

    public function render()
    {
        return view('livewire.post-graduation-steps-index', [
            'students' => $this->students,
        ]);
    }
}
