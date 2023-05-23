<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waves extends Model
{
    use HasFactory;

     protected $fillable = ['fk_surfer','fk_battery'];
}
