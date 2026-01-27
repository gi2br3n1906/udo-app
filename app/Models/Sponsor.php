<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo_path',
        'type',
    ];
    protected function logoUrl(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => str_starts_with($this->logo_path ?? '', 'http') 
                ? $this->logo_path 
                : \Illuminate\Support\Facades\Storage::url($this->logo_path),
        );
    }
}
