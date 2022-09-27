<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_fname',
        'visitor_lname',
        'visitor_email',
        'visitor_id_number',
        'visitor_country_code',
        'visitor_phone_number',
        'visit_date',
        'time_in',
        'time_out',
        'visitor_status'
    ];
}
