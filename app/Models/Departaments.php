<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departaments extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'departaments';
    protected $guarded = [];

    public function country()
    { 
        return $this->belongsTo(Countries::class, 'id_country'); 
    }
    
    public function cities()
    { 
        return $this->hasMany(Cities::class, 'id_Departaments'); 
    }
    
    public function sensors()
    { 
        return $this->hasMany(Sensor::class, 'id_departament'); // ← CORREGIDO: sin 's'
    }
}