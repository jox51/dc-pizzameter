<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularityAverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'iteration_id',
        'pizza_average_popularity',
        'bar_average_popularity',
        'pizza_bar_ratio',
        'pizza_count',
        'bar_count'
    ];
}