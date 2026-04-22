<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_sport')
                    ->withPivot('enrolled_date')
                    ->withTimestamps();
    }

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'coach_sport')
                    ->withTimestamps();
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}