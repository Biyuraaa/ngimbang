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
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
