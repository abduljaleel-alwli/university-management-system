<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use App\Models\Department;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class StudentReports extends Component
{
    use WithPagination;

    public $search = [];
    public $departments;
    protected $queryString = ['search'];
    public $shouldSearch = false;


    public function mount()
    {
        $this->departments = Department::all();
    }

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function export()
    {
        return Excel::download(new StudentsExport($this->search), 'students_report.xlsx');
    }

    public function searchStudents()
    {
        $this->shouldSearch = true;
    }


    public function getStudentsProperty()
    {
        $students = Student::query();

        if ($this->shouldSearch) {
            foreach ($this->search as $key => $value) {
                if (!empty($value)) {
                    if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                        $students->where(function ($query) use ($key, $value) {
                            $query->where($key . '_ar', 'like', '%' . $value . '%')
                                ->orWhere($key . '_en', 'like', '%' . $value . '%');
                        });
                    } elseif (in_array($key, ['email', 'phone_number'])) {
                        $students->where($key, 'like', '%' . $value . '%');
                    } else {
                        $students->where($key, $value);
                    }
                }
            }
        }

        return $students->paginate(10);
    }

    public function render()
    {
        return view('livewire.student-reports', [
            'students' => $this->students, // استخدام الخاصية المحسوبة
        ]);
    }

}
