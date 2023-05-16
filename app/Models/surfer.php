<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surfer extends Model
{

    protected $fillable = ['name', 'country'];

    use HasFactory;

}
