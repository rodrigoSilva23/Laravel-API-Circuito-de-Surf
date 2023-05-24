<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    protected $fillable = [
        'fk_wave',
        'partial_grades1',
        'partial_grades2',
        'partial_grades3'
    ];

    use HasFactory;
}
