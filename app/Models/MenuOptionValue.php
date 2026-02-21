<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuOptionValue extends Model
{
    protected $fillable = [
        'menu_option_id',
        'label',
        'additional_price',
    ];

    public function option()
    {
        return $this->belongsTo(MenuOption::class, 'menu_option_id');
    }
}

