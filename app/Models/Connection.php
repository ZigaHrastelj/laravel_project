<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connection extends Model
{
    use HasFactory;

    protected $fillable = ['userId', 'BadgeId', 'TeacherId', 'PostId'];
}
