<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //

    protected $table = 'animals';

    protected $fillable = [
        'farm_id',
        'name',
        'slug',
        'species',
        'description',
        'total_population',
        'male_count',
        'female_count',
        'image',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
