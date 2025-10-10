<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
    use SoftDeletes; protected $guarded = [];
    public function city(){ return $this->belongsTo(Cities::class, 'id_city'); }
    public function sensorData(){ return $this->hasMany(Sensor_Data::class, 'id_station'); }

}
