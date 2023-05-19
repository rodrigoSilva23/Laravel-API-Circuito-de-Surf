<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Surfer;
class Battery extends Model
{
    use HasFactory;
    protected $fillable = ['fk_surfer1', 'fk_surfer2'];
}
