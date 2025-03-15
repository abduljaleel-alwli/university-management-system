<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminStudents extends Component
{
    use WithPagination;

    public $search = [
        'first_name' => '',
        'father_name' => '',
        'grandfather_name' => '',
        'last_name' => '',
        'email' => '',
        'phone_number' => '',
        'study_type' => '',
        'admission_channel' => '',
        'academic_stage' => '',
        'status' => '',
        'start_date' => '',
        'study_end_date' => '',
    ];

    protected $queryString = ['search'];


    public function mount()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'You don’t have permission.');
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getStudentsProperty()
    {
        $user = Auth::user();
        $query = Student::query()->where('department_id', $user->department_id);

        foreach ($this->search as $key => $value) {
            if (!empty($value)) {
                if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                    $query->where(function ($q) use ($key, $value) {
                        $q->where($key . '_ar', 'like', "%{$value}%")
                          ->orWhere($key . '_en', 'like', "%{$value}%");
                    });
                } elseif (in_array($key, ['email', 'phone_number'])) {
                    $query->where($key, 'like', "%{$value}%");
                } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage', 'status'])) {
                    $query->where($key, $value);
                } elseif ($key === 'start_date') {
                    $query->whereDate('start_date', '>=', $value);
                } elseif ($key === 'study_end_date') {
                    $query->whereDate('study_end_date', '<=', $value);
                }
            }
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin-students', [
            'students' => $this->students, // استخدام الخاصية المحسوبة
        ]);
    }
}
