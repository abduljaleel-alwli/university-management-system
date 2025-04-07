<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationType extends Model
{
    protected $fillable = ['name_en', 'name_ar'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function getNameAttribute(): string
    {
        $locale = app()->getLocale(); // الحصول على اللغة الحالية
        return $this->{"name_$locale"}; // إرجاع الاسم بناءً على اللغة
    }
}
