<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'id_number',
        'phone_number',
        'appointment_date',
        'expected_time',
        'employee_id',
        'department_id', 
        'appointment_status',
        'created_by',
        'updated_by'
    ];

     /**
     * Get the host for the visitor_appointment.
     */
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
     /**
     * Get the department for the visitor_appointment.
     */
    public function department() {
        return $this->belongsTo(Department::class);
    }
  
}
