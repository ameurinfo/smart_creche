<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CumulativeRecord extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cumulative_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'age',
        'mental_age',
        'disability',
        'family_members',
        'siblings',
        'guardian',
        'child_order',
        'living_with',
        'economic_status',
        'home_status',
        'hearing',
        'vision',
        'taste',
        'touch',
        'speech',
        'chronic_disease',
        'intelligence_tests',
        'special_abilities',
        'psychological_tests',
        'cognitive',
        'attention_concentration',
        'memory',
        'eating',
        'cleanliness',
        'dressing',
        'activities',
        'highly_emotional',
        'introverted',
        'child_id', // Assuming you have a foreign key to the Child model
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
