<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_name',
        'office_number',
        'court_id',
        'department_id'
    ];

    /**
     * Get the department for the office.
     */
    public function department() {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the court for the office.
     */
    public function court() {
        return $this->belongsTo(Court::class);
    }
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
