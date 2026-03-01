<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{

protected $fillable = [
    'name',
    'type',
    'is_active',
];
    public function menus()
{
    return $this->belongsToMany(Menu::class);
}

public function values()
{
    return $this->hasMany(OptionValue::class);
}
}
