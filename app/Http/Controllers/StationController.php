<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sensor_Data;

class StationController extends Controller
{
    use SoftDeletes; protected $guarded = [];
    public function city(){ return $this->belongsTo(Cities::class, 'id_city'); }
    public function sensorData(){ return $this->hasMany(Sensor_Data::class, 'id_station'); }

    //
}
