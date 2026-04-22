<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'specialization',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'coach_sport')
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}