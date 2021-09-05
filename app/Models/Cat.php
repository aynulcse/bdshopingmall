<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Subcat;

class Cat extends Model
{
    
    public function subcat()
    {
    	return $this->hasMany(Subcat::class ,'cat_id');
    }
}
