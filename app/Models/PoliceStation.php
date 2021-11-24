<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    protected $table = 'police_stations';

    public function division()
    {
    	return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
    	return $this->belongsTo(District::class, 'district_id');
    }
}
