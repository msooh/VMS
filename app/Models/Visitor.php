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
        'visit_date',
        'time_in',
        'time_out',
        'employee_id',
        'office_id', 
        'avatar',
        'badge_id',
        'visitor_status',
        'created_by',
        'updated_by'
    ];

     /**
     * Get the employee for the visitor.
     */
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
     /**
     * Get the office for the visitor.
     */
    public function office() {
        return $this->belongsTo(Office::class);
    }
      /**
     * Get the badge for the visitor.
     */
    public function badge() {
        return $this->belongsTo(Badge::class);
    }
}

        