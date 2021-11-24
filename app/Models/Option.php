<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';

    public function select()
    {
    	return $this->belongsTo(Select::class, 'select_id');
    }
}
