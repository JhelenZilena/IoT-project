<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countries extends Model
{
    use SoftDeletes; 
    
    protected $guarded = [];
    
    // CORREGIDO: Cambiar departments por Departaments
    public function Departaments()
    { 
        return $this->hasMany(Departaments::class, 'id_country'); 
    }
}