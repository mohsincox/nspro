<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id');
    }
}
