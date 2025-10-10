<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departaments extends Model
{
    use SoftDeletes; protected $guarded = [];
    public function country(){ return $this->belongsTo(Countries::class, 'id_country'); }
    public function cities(){ return $this->hasMany(Cities::class, 'id_department'); }
    public function sensors(){ return $this->hasMany(Sensor::class, 'id_department'); }

}
