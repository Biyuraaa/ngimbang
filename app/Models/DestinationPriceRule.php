<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationPriceRule extends Model
{
    //

    protected $table = 'destination_price_rules';

    protected $fillable = [
        'destination_id',
        'price_rule_type_id',
        'price',
        'status',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function priceRuleType()
    {
        return $this->belongsTo(PriceRuleType::class);
    }
}
