<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_no',
        'visitor_id',
        'visit_date',
        'time_in',
        'time_out',
        'employee_id',
        'department_id', 
        'badge_id',
        'visitor_status',
        'visit_reason',
        'comments',
        'created_by',
        'updated_by'
    ];

     /**
     * Get the employee for the visit.
     */
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
     /**
     * Get the office for the visit.
     */
    public function office() {
        return $this->belongsTo(Office::class);
    }
      /**
     * Get the badge for the visit.
     */
    public function badge() {
        return $this->belongsTo(Badge::class);
    }
       /**
     * Get the visitor for the visit.
     */
    public function visitor() {
        return $this->belongsTo(Visitor::class);
    }
    
}
