<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'date',
        'staff_id',
        'arrival_time',
        'departure_time',
        'notes'
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
