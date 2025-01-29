<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'title_japanese',
        'synopsis',
        'image_url',
        'episodes',
        'status',
        'rating',
        'genres'
    ];

    protected $casts = [
        'genres' => 'array',
        'rating' => 'float'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
} 