<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalFollowUp extends Model
{
    use HasFactory;
    
    protected $fillable = ['behaviors', 'overall_rating'];

    protected $casts = [
        'behaviors' => 'array',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }


}
