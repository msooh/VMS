<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name', 'created_by', 'updated_by',
    ];
    /**
     * Get the department for the office.
     */
    public function offices()
    {
        return $this->hasMany(Office::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
}
