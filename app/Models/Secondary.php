<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secondary extends Model
{
    protected $table = 'secondaries';

    public function primaryN()
    {
    	return $this->belongsTo(PrimaryN::class, 'primary_n_id');
    }
}
