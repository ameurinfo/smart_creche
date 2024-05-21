<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthdate',
        'gender',
        'address',
        'phone_number',
        'email',
        'image',
        'notes',
        'parents_id',
    ];

    public function parents()
    {
        return $this->belongsTo(Parents::class);
    } 

    public function educational_follow_up()
    {
        return $this->hasMany(EducationalFollowUp::class);
    }
    
    public function health_follow_up()
    {
        return $this->hasMany(HealthFollowUp::class);
    }

    public function psychological_follow_up()
    {
        return $this->hasMany(PsychologicalFollowUp::class);
    }
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function meals()
    {
        return $this->hasMany(Meals::class);
    }
    public function sleeps()
    {
        return $this->hasMany(Sleep::class);
    }

}
