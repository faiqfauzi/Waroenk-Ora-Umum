<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'menu_image', 'category_id'];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
