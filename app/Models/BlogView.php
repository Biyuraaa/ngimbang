<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    //

    protected $table = 'blog_views';

    protected $fillable = [
        'blog_id',
        'ip_address',
        'user_agent',
        'user_id'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
