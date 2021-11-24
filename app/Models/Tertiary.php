<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tertiary extends Model
{
    protected $table = 'tertiaries';

    public function primaryN()
    {
    	return $this->belongsTo(PrimaryN::class, 'primary_n_id');
    }

    public function secondary()
    {
    	return $this->belongsTo(Secondary::class, 'secondary_id');
    }
}
