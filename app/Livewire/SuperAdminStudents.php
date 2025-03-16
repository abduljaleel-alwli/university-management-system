<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SuperAdminStudents extends Component
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
        'department_id' => '',
    ];

    public $departments;

    protected $queryString = ['search'];

    public function mount()
    {
        if (!Auth::user()->hasRole('super-admin')) {
            abort(403, __('You don’t have permission.'));
        }

        $this->departments = Department::all();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getStudentsProperty()
    {
        $query = Student::query();

        foreach ($this->search as $key => $value) {
            if (!empty($value)) {
                if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                    $query->where(function ($q) use ($key, $value) {
                        $q->where($key . '_ar', 'like', "%{$value}%")
                          ->orWhere($key . '_en', 'like', "%{$value}%");
                    });
                } elseif (in_array($key, ['email', 'phone_number'])) {
                    $query->where($key, 'like', "%{$value}%");
                } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage', 'status', 'department_id'])) {
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
        return view('livewire.super-admin-students', [
            'students' => $this->students,
        ]);
    }
}
