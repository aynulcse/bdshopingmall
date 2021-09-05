<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cat;

class Product extends Model
{
    public function images()
    {
    	return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
    	return $this->belongsTo(Cat::class ,'cat_id');
    }
}
