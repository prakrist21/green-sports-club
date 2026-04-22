<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id',
        'amount',
        'period',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}