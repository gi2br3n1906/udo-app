<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'menu_list',
        'price_range',
        'map_booth_id',
    ];

    protected $casts = [
        'menu_list' => 'array',
    ];
}
