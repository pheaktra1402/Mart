<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Product extends Model
{
protected $fillable = ['category_id', 'name', 'price', 'stock'];

public function category()
{
    return $this->belongsTo(Category::class);
}
}
