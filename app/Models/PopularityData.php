<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularityData extends Model
{
    use HasFactory;

    protected $fillable = ['place_id', 'name', 'type', 'current_popularity', 'iteration_id'];
}