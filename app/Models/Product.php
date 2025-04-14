<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orders()
{
    return $this->hasMany(Order::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
}
