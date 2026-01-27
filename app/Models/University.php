<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_path',
        'map_booth_id',
        'website_url',
        'is_favorite',
    ];
    protected function logoUrl(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => str_starts_with($this->logo_path ?? '', 'http') 
                ? $this->logo_path 
                : \Illuminate\Support\Facades\Storage::url($this->logo_path),
        );
    }

    // Relationship: Visitors who favorited this university
    public function favoritedBy()
    {
        return $this->belongsToMany(Visitor::class, 'university_visitor')
            ->withTimestamps();
    }

    public function getIsFavoritedByAuthUserAttribute()
    {
        $visitorId = request()->cookie('visitor_registered');
        if (!$visitorId) {
            return false;
        }
        
        return $this->favoritedBy()->where('visitor_id', $visitorId)->exists();
    }
}
