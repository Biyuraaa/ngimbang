<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceRuleType extends Model
{
    //

    protected $table = 'price_rule_types';

    protected $fillable = [
        'name',
        'description',
    ];

    public function destinationPriceRules()
    {
        return $this->hasMany(DestinationPriceRule::class);
    }
}
