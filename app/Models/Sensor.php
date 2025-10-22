<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'abbrev',
        'status',
        'id_departament', // ← CORREGIDO: sin 's'
    ];

    /**
     * Relación con Departaments
     */
    public function Departaments()
    {
        return $this->belongsTo(Departaments::class, 'id_departament'); // ← CORREGIDO: sin 's'
    }

    /**
     * Relación con los datos del sensor
     */
    public function data()
    {
        return $this->hasMany(Sensor_Data::class, 'id_sensor');
    }
}