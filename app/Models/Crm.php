<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Crm extends Model
{
    protected $table = 'crms';

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

    public function primaryN()
    {
        return $this->belongsTo(PrimaryN::class, 'primary_n_id');
    }

    public function secondaryN()
    {
        return $this->belongsTo(Secondary::class, 'secondary_id');
    }

    public function tertiaryN()
    {
        return $this->belongsTo(Tertiary::class, 'tertiary_id');
    }
}
