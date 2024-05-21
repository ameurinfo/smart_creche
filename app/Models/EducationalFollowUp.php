<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalFollowUp extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'child_id',
        'date',
        'academic_assessment',
        'learning_plan',
        'progress_notes'
    ];


}
