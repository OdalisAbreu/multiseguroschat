<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_models extends Model
{
    use HasFactory;
    public function vehicletype()
    {
        return $this->belongsToMany(Vehicletype::class, 'vehicletype_vehiclemodels', 'vehicleModelId', 'vehicleTypeId');
    }
}
