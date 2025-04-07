<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use App\Notifications\StudyExtensionAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Notification;

class SendStudentNotification extends Component
{
    use WithPagination;

    public $student_id;
    public $admin_id;
    public $message;

    public $search = [
        'user_name' => '',
        'user_email' => '',
        'student_first_name' => '',
        'student_father_name' => '',
        'student_grandfather_name' => '',
        'student_last_name' => '',
        'student_email' => '',
        'student_phone_number' => '',
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
            abort(403, __("You are not authorized"));
        }

        $this->departments = Department::all();
    }

    public function searchStudents()
    {
        $this->resetPage();
    }

    public function getUsersProperty()
    {
        $query = User::query()->role('Admin');

        if (!empty($this->search['user_name'])) {
            $query->where('name', 'like', "%{$this->search['user_name']}%");
        }

        if (!empty($this->search['user_email'])) {
            $query->where('email', 'like', "%{$this->search['user_email']}%");
        }

        return $query->paginate(10);
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
                } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage', 'department_id'])) {
                    $query->where($key, $value);
                } elseif ($key === 'status') {
                    if (in_array($value, ['active', 'suspended', 'pending_review'])) {
                        $query->where('status', $value)
                        ->whereDoesntHave('postGraduationStep'); // ✅ تأكد من عدم وجود بيانات في post_graduation_steps;
                    }elseif ($value === 'pending_review') {
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

        return $query->paginate(10);
    }

    public function sendNotification()
    {
        if (!Auth::user()->hasRole('super-admin')) {
            session()->flash('error', __('You are not authorized to send notifications.'));
            return;
        }

        $student = Student::find($this->student_id);
        $admin = User::find($this->admin_id);

        if ($student && $admin) {
            $admin->notify(new StudyExtensionAlert($student, $this->message));
            session()->flash('success', __('The notification was sent successfully.'));
        } else {
            session()->flash('error', __('An error occurred while sending.'));
        }
    }

    public function render()
    {
        return view('livewire.send-student-notification', [
            'admins' => $this->users,
            'students' => $this->students,
            'departments' => $this->departments,
        ]);
    }
}

