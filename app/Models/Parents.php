<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Parents extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'relationship',
        'job',
        'phone_number',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }

}
