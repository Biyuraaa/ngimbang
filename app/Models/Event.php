<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $table = 'events';


    protected $fillable = [
        'user_id',
        'title',
        'description',
        'slug',
        'price',
        'registration_url',
        'start_at',
        'end_at',
        'start_date',
        'end_date',
        'location',
        'thumbnail',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
