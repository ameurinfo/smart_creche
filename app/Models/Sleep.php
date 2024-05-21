<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
