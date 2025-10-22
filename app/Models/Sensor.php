<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
    use HasFactory, SoftDeletes;

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'code',
        'abbrev',
        'status',
        'id_department', // coincide con tu tabla y tu modelo actual
    ];

    /**
     * Relación con Departaments
     * Cada sensor pertenece a un departamento
     */
    public function departaments()
    {
        return $this->belongsTo(Departaments::class, 'id_department'); // referencia tu modelo actual
    }

    /**
     * Relación con los datos del sensor (telemetría)
     */
    public function data()
    {
        return $this->hasMany(Sensor_Data::class, 'id_sensor');
    }
}
