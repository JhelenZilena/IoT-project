<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use SoftDeletes; protected $guarded = [];
    public function department(){ return $this->belongsTo(Departaments::class, 'id_department'); }
    public function data(){ return $this->hasMany(Sensor_Data::class, 'id_sensor'); }

}
