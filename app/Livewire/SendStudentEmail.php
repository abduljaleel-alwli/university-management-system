<?php

namespace App\Livewire;

use App\Mail\StudentNotificationMail;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class SendStudentEmail extends Component
{
    use WithPagination;

    public $student_id;
    public $subject;
    public $message;
    public $link;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'link' => 'nullable|url',
    ];

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
        if (!Auth::user()->hasRole('admin')) {
            abort(403, __("You don’t have permission."));
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
                } elseif (in_array($key, ['study_type', 'admission_channel', 'academic_stage'])) {
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

    public function sendEmail()
    {
        $this->validate();

        $student = Student::find($this->student_id);

        if ($student) {
            Mail::to($student->email)->send(new StudentNotificationMail($this->subject, $this->message, $this->link ?? null));

            session()->flash('success', __('Email sent successfully!'));
        } else {
            session()->flash('error', __('An error occurred while sending mail.'));
        }
    }

    public function render()
    {
        return view('livewire.send-student-email', [
            'students' => $this->students,
        ]);
    }
}
