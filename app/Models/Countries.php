<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Countries extends Model
{
    use SoftDeletes; protected $guarded = [];
    public function departments(){ return $this->hasMany(Departaments::class, 'id_country'); }
}
