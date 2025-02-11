<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
        'commentable_id',
        'commentable_type',
        'user_id',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
