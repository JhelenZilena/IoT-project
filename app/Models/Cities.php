<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes; protected $guarded = [];
    public function department(){ return $this->belongsTo(Departaments::class, 'id_department'); }
    public function stations(){ return $this->hasMany(Station::class, 'id_city'); }

}
