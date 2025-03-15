<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\PostGraduationStep;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PostGraduationSteps extends Component
{
    use WithPagination;

    public $student;
    public $step;
    public $student_id;
    public $discussion_date;
    public $committee_decision;
    public $clearance = false;
    public $sent_to_college = false;
    public $sent_to_ministry = false;
    public $archived = false;
    public $post_graduation_status;

    public $hasChanges = false;

    public $statuses;

    protected $rules = [
        'discussion_date' => 'nullable|date',
        'committee_decision' => 'nullable|string|max:255',
        'clearance' => 'boolean',
        'sent_to_college' => 'boolean',
        'sent_to_ministry' => 'boolean',
        'archived' => 'boolean',
        'post_graduation_status' => 'required|in:graduate,fail,pending_review',
    ];

    public function mount($student_id)
    {
        $this->student_id = $student_id;
        $this->student = Student::findOrFail($student_id);

        $user = Auth::user();

        // التحقق من الصلاحيات
        if (
            !($user->hasRole('super-admin') ||
                ($user->hasRole('admin') && $this->student->department_id === $user->department_id))
        ) {
            abort(403); // منع الوصول
        }

        $this->step = PostGraduationStep::firstOrCreate(
            ['student_id' => $student_id],
            ['post_graduation_status' => 'pending_review']
        );

        $this->statuses = [
            'graduate' => __('Graduate'),
            'fail' => __('Fail'),
            'pending_review' => __('Pending review')
        ];

        // تحميل البيانات إلى المتغيرات
        $this->discussion_date = $this->step->discussion_date;
        $this->committee_decision = $this->step->committee_decision;
        $this->clearance = $this->step->clearance;
        $this->sent_to_college = $this->step->sent_to_college;
        $this->sent_to_ministry = $this->step->sent_to_ministry;
        $this->archived = $this->step->archived;
        $this->post_graduation_status = $this->step->post_graduation_status;
    }

    // السماح بالتحديث فقط لمسؤولي الأقسام
    public function save()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'غير مسموح لك بتحديث البيانات.');
        }

        $this->validate();

        $this->step->update([
            'discussion_date' => $this->discussion_date,
            'committee_decision' => $this->committee_decision,
            'clearance' => $this->clearance,
            'sent_to_college' => $this->sent_to_college,
            'sent_to_ministry' => $this->sent_to_ministry,
            'archived' => $this->archived,
            'post_graduation_status' => $this->post_graduation_status,
        ]);

        $this->hasChanges = false;
        session()->flash('message', 'تم حفظ التغييرات بنجاح.');
    }

    // تحديث البيانات عند التغيير
    public function updated($propertyName)
    {
        if (!Auth::user()->hasRole('admin')) {
            return;
        }

        $this->validateOnly($propertyName);
        $this->hasChanges = true;
        $this->step->$propertyName = $this->$propertyName;
        $this->step->save();

        // إعادة تحميل القيم بعد الحفظ
        $this->step = PostGraduationStep::find($this->step->id);

        session()->flash('message', 'تم تحديث البيانات بنجاح.');
    }


    public function render()
    {
        return view('livewire.post-graduation-steps', [
            'student' => $this->student,
            'step' => $this->step,
        ]);
    }
}
