<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $guarded = [];

    // Relación: Una estación pertenece a una ciudad
    public function city()
    {
        return $this->belongsTo(Cities::class, 'id_city');
    }

    // Relación: Una estación tiene muchos datos de sensores
    public function sensorData()
    {
        return $this->hasMany(Sensor_Data::class, 'id_station');
    }
}