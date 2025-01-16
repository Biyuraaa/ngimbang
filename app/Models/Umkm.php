<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umkm extends Model
{
    //
    use SoftDeletes;

    protected $table = 'umkms';


    protected $fillable = [
        'user_id',
        'name',
        'description',
        'phone',
        'thumbnail',
        'slug',
        'address',
    ];

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }


    public function socialMedia()
    {
        return $this->morphMany(ModelSocialMedia::class, 'modelable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
