<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'slug',
        'umkm_id',
        'thumbnail',
        'status',
        'price',
        'category_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }


    public function averageRating()
    {
        return $this->ratings()->avg('score') ?? 0;
    }



    public function socialMedia()
    {
        return $this->morphMany(ModelSocialMedia::class, 'modelable');
    }

    public function ratingCount()
    {
        return $this->ratings()->count();
    }


    public function getRatingDistribution()
    {
        return $this->ratings()
            ->selectRaw('score, COUNT(*) as count')
            ->groupBy('score')
            ->orderBy('score', 'desc')
            ->get();
    }
}
