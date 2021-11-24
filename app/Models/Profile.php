<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['phone_number', 'consumer_name', 'consumer_age', 'consumer_gender', 'profession', 'division_id', 'address', 'brand_id', 'activity_campaign_name', 'sec', 'interested_in_crm', 'interested_in_fnm', 'kids_age', 'created_by'];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function policeStation()
    {
        return $this->belongsTo(PoliceStation::class, 'police_station_id');
    }
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
