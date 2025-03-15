<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en'
    ];

    public function getNameAttribute(): string
    {
        $locale = app()->getLocale(); // الحصول على اللغة الحالية
        return $this->{"name_$locale"}; // إرجاع الاسم بناءً على اللغة
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    // جلب الطلاب المستمرين في القسم
    public function activeStudents()
    {
        return $this->student()
            ->where(function ($query) {
                $query->whereDoesntHave('postGraduationStep') // إذا لم يكن لديه بيانات في postGraduationStep
                    ->orWhereHas('postGraduationStep', function ($q) {
                        $q->whereColumn('post_graduation_status', 'students.status'); // تطابق الحالتين
                    });
            });
    }

    // جلب الطلاب الراسبين في القسم
    public function failedStudents()
    {
        return $this->student()->whereHas('postGraduationStep', function ($query) {
            $query->where('post_graduation_status', 'fail');
        });
    }

    // جلب الطلاب الخريجين في القسم
    public function graduatedStudents()
    {
        return $this->student()->whereHas('postGraduationStep', function ($query) {
            $query->where('post_graduation_status', 'graduate');
        });
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
