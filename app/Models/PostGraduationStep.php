<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostGraduationStep extends Model
{
    protected $fillable = [
        'student_id',
        'discussion_date',
        'committee_decision',
        'clearance',
        'sent_to_college',
        'sent_to_ministry',
        'archived',
        'post_graduation_status',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function getStatusTranslatedAttribute()
    {
        return match ($this->post_graduation_status) {
            'graduate' => __('Graduate'),              // مستمر
            'fail' => __('Fail'),        // مؤجل
            'pending_review' => __('Pending Review'), // قيد المراجعة
            default => __('Not Available'),
        };
    }
}
