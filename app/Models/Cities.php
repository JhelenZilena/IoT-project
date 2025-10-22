<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes; 
    
    protected $guarded = [];
    
    // CORREGIDO: Cambiar department por Departaments
    public function Departaments()
    { 
        return $this->belongsTo(Departaments::class, 'id_Departaments'); 
    }
    
    public function stations()
    { 
        return $this->hasMany(Station::class, 'id_city'); 
    }
}