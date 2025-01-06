<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'slug',
        'thumbnail',
        'excerpt',
        'status',
        'view_count'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags');
    }

    public function blogTags()
    {
        return $this->hasMany(BlogTag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function blogViews()
    {
        return $this->hasMany(BlogView::class);
    }
}
