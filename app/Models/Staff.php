<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthdate',
        'gender',
        'address',
        'phone_number',
        'email',
        'job_title',
        'hire_date',
        'academic_qualifications',
        'previous_experiences',
        'training_courses',
        'image',
        'notes',
        'job_type_id',
    ];

    public function jobTypes()
    {
        return $this->belongsTo(JobType::class);
    }
}
