<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_number', 'court_id',
    ];

    public function court() {
        return $this->belongsTo(Court::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
