<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $table = 'ratings';

    protected $fillable = [
        'score',
        'review',
        'user_id',
        'rateable_id',
        'rateable_type',
    ];


    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
