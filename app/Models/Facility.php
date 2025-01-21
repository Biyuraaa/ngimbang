<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //

    protected $table = 'facilities';

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'quantity',
        'destination_id',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
