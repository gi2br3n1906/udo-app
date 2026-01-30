<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'school_origin',
        'phone',
        'dream_major',
        'visited_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    // Relationship: Universities favorited by this visitor
    public function favoriteUniversities()
    {
        return $this->belongsToMany(University::class, 'university_visitor')
            ->withTimestamps();
    }
}
