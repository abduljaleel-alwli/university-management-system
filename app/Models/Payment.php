<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'student_id',
        'department_id',
        'author_id',
        'editor_id',
        'amount',
        'currency',
        'payment_date',
        'notes',
    ];

    // توليد رقم الوصل تلقائيًا
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($payment) {
            $payment->receipt_number = 'RCPT-' . strtoupper(Str::random(10));
        });
    }

    // --> student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // --> admin
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
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
}
