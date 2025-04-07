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
        $query = Student::query();

        // if ($this->shouldSearch) {
            foreach ($this->search as $key => $value) {
                if (!empty($value)) {
                    if (in_array($key, ['first_name', 'father_name', 'grandfather_name', 'last_name'])) {
                        $query->where(function ($q) use ($key, $value) {
                            $q->where($key . '_ar', 'like', "%{$value}%")
                                ->orWhere($key . '_en', 'like', "%{$value}%");
                        });
                    } elseif (in_array($key, ['email', 'phone_number'])) {
                        $query->where($key, 'like', "%{$value}%");
                    } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage', 'department_id'])) {
                        $query->where($key, $value);
                    } elseif ($key === 'status') {
                        if (in_array($value, ['active', 'suspended', 'pending_review'])) {
                            $query->where('status', $value)
                                ->whereDoesntHave('postGraduationStep'); // ✅ تأكد من عدم وجود بيانات في post_graduation_steps;
                        } elseif ($value === 'pending_review') {
                            $query->where(function ($q) {
                                $q->where('status', 'pending_review')
                                    ->whereDoesntHave('postGraduationStep') // ✅ الطلاب الذين لم يدخلوا مرحلة ما بعد التخرج
                                    ->orWhereHas('postGraduationStep', function ($subQuery) {
                                        $subQuery->where('post_graduation_status', 'pending_review'); // ✅ الطلاب الذين لديهم post_graduation_status = pending_review
                                    });
                            });
                        } elseif (in_array($value, ['graduate', 'fail',])) {
                            $query->whereHas('postGraduationStep', function ($q) use ($value) {
                                $q->where('post_graduation_status', $value);
                            });
                        }
                    } elseif ($key === 'start_date') {
                        $query->whereDate('start_date', '>=', $value);
                    } elseif ($key === 'study_end_date') {
                        $query->whereDate('study_end_date', '<=', $value);
                    }
                }
            }

        // }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.student-reports', [
            'students' => $this->students, // استخدام الخاصية المحسوبة
        ]);
    }

}
