<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Destination extends Model
{
    //

    use SoftDeletes, HasFactory;

    protected $table = 'destinations';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'description',
        'slug',
        'address',
        'open_at',
        'close_at',
        'thumbnail',
        'status',
    ];

    protected $appends = ['average_rating'];

    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('score') ?? 0;
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('score') ?? 0;
    }
    public function getRatingDistribution()
    {
        return $this->ratings()
            ->selectRaw('score, COUNT(*) as count')
            ->groupBy('score')
            ->orderBy('score', 'desc')
            ->get();
    }

    public function ratingCount()
    {
        return $this->ratings()->count();
    }

    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }

    public function destinationPriceRules()
    {
        return $this->hasMany(DestinationPriceRule::class);
    }

    public function socialMedia()
    {
        return $this->morphMany(ModelSocialMedia::class, 'modelable');
    }
}
