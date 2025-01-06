<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agriculture extends Model
{
    //
    use SoftDeletes;

    protected $table = 'agriculture';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'status',
        'address',
        'land_size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function models()
    {
        return $this->morphMany(ModelSocialMedia::class, 'modelable');
    }
}
