<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_type_tarif extends Model
{
    use HasFactory;
    public function prices(){
        return $this->hasMany(Price::class);
    }
}
