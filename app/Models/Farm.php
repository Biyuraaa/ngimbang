<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farm extends Model
{
    //

    use SoftDeletes;
    protected $table = 'farms';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'slug',
        'status',
        'description',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }


    public function models()
    {
        return $this->hasMany(ModelSocialMedia::class);
    }
}
