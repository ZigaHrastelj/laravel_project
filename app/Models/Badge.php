<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = ['slika', 'pogoj', 'ponovitev', 'badgeCount', 'points'];

    function posts() {
        return $this->hasMany(Post::class, 'badgeCount');
    }
}
