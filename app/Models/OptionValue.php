<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = [
    'option_group_id',
    'label',
    'additional_price',
    'is_available',
];
    public function group()
{
    return $this->belongsTo(OptionGroup::class, 'option_group_id');
}
}
