<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name_ar',
        'first_name_en',
        'father_name_ar',
        'father_name_en',
        'grandfather_name_ar',
        'grandfather_name_en',
        'last_name_ar',
        'last_name_en',
        'email',
        'phone_number',
        'study_type', // ماجستير أو دكتوراه
        'admission_channel', // خاصة أو عامة
        'academic_stage', // السنة التحضيرية أو السنة البحثية
        'status', // مستمر، مؤجل، أو قيد المراجعة
        'specialization_type',
        'notes',
        'study_end_date',
        'start_date',
        'remaining_study_days',
        'first_extension_date',
        'second_extension_date',
        'department_id', // قسم الطالب
        'last_notification_sent_at', // تاريخ اخر اشعار تم ارسالة للمسؤولين بشان الطالب
        'author_id', // المؤلف (عادةً السوبر أدمن أو الأدمن المسؤول عن إدخال البيانات)
        'editor_id', // المحرر (الذي قام بتعديل البيانات في المستقبل)
    ];


    // حساب تاريخ انتهاء الدراسة بناءً على نوع الدراسة
    public function calculateStudyEndDate()
    {
        return Carbon::parse($this->start_date)->addYears($this->study_type === 'msc' ? 2 : 3);
    }

    // معرفة ما إذا كان الطالب قريبًا من انتهاء الدراسة (قبل 3 أشهر)
    public function isNearEnd()
    {
        return Carbon::now()->addMonths(3)->greaterThanOrEqualTo($this->study_end_date);
    }

    // تمديد الدراسة (6 أشهر فقط)
    public function extendStudy()
    {
        if (!$this->first_extension_date) {
            $this->first_extension_date = Carbon::parse($this->study_end_date)->addMonths(6);
            $this->save();
            return 'تم التمديد الأول بنجاح';
        } elseif (!$this->second_extension_date) {
            $this->second_extension_date = Carbon::parse($this->first_extension_date)->addMonths(6);
            $this->save();
            return 'تم التمديد الثاني بنجاح';
        } else {
            return 'لا يمكن التمديد أكثر من مرتين';
        }
    }


    // --> department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // --> author
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // --> editor
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    // --> postGraduationStep
    public function postGraduationStep()
    {
        return $this->hasOne(PostGraduationStep::class);
    }


    /**
     * الحصول على القيمة المترجمة لأي حقل بناءً على اللغة الحالية.
     *
     */
    public function getTranslatedAttribute(string $attribute): string
    {
        $locale = app()->getLocale(); // الحصول على اللغة الحالية
        $translatedAttribute = "{$attribute}_{$locale}"; // بناء اسم الحقل المترجم

        return $this->{$translatedAttribute} ?? ''; // إرجاع القيمة أو سلسلة فارغة إذا لم تكن موجودة
    }

    // للحصول على الاسم الأول بناءً على اللغة
    public function getFirstNameAttribute(): string
    {
        return $this->getTranslatedAttribute('first_name');
    }

    // للحصول على اسم الأب بناءً على اللغة
    public function getFatherNameAttribute(): string
    {
        return $this->getTranslatedAttribute('father_name');
    }

    // للحصول على اسم الجد بناءً على اللغة
    public function getGrandfatherNameAttribute(): string
    {
        return $this->getTranslatedAttribute('grandfather_name');
    }

    // للحصول على اللقب بناءً على اللغة
    public function getLastNameAttribute(): string
    {
        return $this->getTranslatedAttribute('last_name');
    }

    /**
     * دمج حقول الاسم في عمود واحد بناءً على اللغة الحالية.
     */
    public function getFullNameAttribute(): string
    {
        $firstName = $this->getTranslatedAttribute('first_name');
        $fatherName = $this->getTranslatedAttribute('father_name');
        $grandfatherName = $this->getTranslatedAttribute('grandfather_name');
        $lastName = $this->getTranslatedAttribute('last_name');

        return "{$firstName} {$fatherName} {$grandfatherName} {$lastName}";
    }

    public function getStudyTypeTranslatedAttribute()
    {
        return match ($this->study_type) {
            'msc' => __('Master'),   // ماجستير
            'phd' => __('PhD'),      // دكتوراه
            default => __('Not Available'),
        };
    }

    public function getAdmissionChannelTranslatedAttribute()
    {
        return match ($this->admission_channel) {
            'private' => __('Private'),  // قناة خاصة
            'public' => __('Public'),    // قناة عامة
            default => __('Not Available'),
        };
    }

    public function getAcademicStageTranslatedAttribute()
    {
        return match ($this->academic_stage) {
            'preparatory' => __('Preparatory Stage'), // السنة التحضيرية
            'research' => __('Research Stage'),      // السنة البحثية
            default => __('Not Available'),
        };
    }

    public function getStatusTranslatedAttribute()
    {
        return match ($this->status) {
            'active' => __('Active'),              // مستمر
            'suspended' => __('Suspended'),        // مؤجل
            'pending_review' => __('Pending Review'), // قيد المراجعة
            default => __('Not Available'),
        };
    }

    public function getSpecializationTypeTranslatedAttribute()
    {
        return match ($this->specialization_type) {
            'graduation_project' => __('Graduation Project'), // مشروع تخرج
            'pure_sciences' => __('Pure Sciences'),          // علوم صرفة
            'teaching_methods' => __('Teaching Methods'),    // طرائق تدريس
            default => __('Not Available'),
        };
    }
}
