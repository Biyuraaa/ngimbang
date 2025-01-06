<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelSocialMedia extends Model
{
    //

    protected $table = 'model_social_media';

    protected $fillable = [
        'social_media_id',
        'model_id',
        'model_type',
    ];

    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}
