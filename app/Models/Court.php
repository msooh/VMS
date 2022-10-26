<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'court_name',
    ];

    /**
     * Get the court for the office.
     */

    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    public function badges()
    {
        return $this->hasMany(Badge::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
