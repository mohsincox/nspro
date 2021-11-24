<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UpsellCrm extends Model
{
    protected $table = 'upsell_crms';

    public function profile()
    {
    	return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
