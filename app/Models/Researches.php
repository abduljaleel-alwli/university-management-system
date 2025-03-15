<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researches extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'student_id',
        'department_id',
        'journal_name',
        'journal_url',
        'publication_date',
        'research_url',
        'notes',
        'status',
        'author_id',
        'editor_id'
    ];

    public function getTitleAttribute(): string
    {
        $locale = app()->getLocale(); // الحصول على اللغة الحالية
        return $this->{"title_$locale"}; // إرجاع الاسم بناءً على اللغة
    }

    // العلاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // العلاقة مع القسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // العلاقة مع المؤلف
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // العلاقة مع المحرر
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }


    public function publishedResearches()
    {
        return $this->wheres('status', 'published');
    }

    // جلب الطلاب الراسبين في القسم
    public function acceptedResearches()
    {
        return $this->wheres('status', 'accepted');
    }
}
