<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    //

    protected $table = 'attractions';

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'price',
        'destination_id',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
