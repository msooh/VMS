<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_name',
        'visitor_email',
        'visitor_id_number',
        'visitor_phone_number', 
        'avatar',
        'created_by',
        'updated_by'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

        