<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email',
        'phno', 'est_number',
        'office_id', 'role_id',
         'created_by', 'updated_by',
    ];

    /**
     * Get the department for the employee.
     */
    public function department() {
        return $this->belongsTo(Department::class);
    }
     /**
     * Get the office for the employee.
     */
    public function office() {
        return $this->belongsTo(Office::class);
    }

    /**
     * Get the role for the employee.
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
