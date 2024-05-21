<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'date',
        'meal_type',
        'description',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
