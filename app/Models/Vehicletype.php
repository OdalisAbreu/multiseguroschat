<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicletype extends Model
{
    use HasFactory;
    public function vehicle_models()
    {
        return $this->belongsToMany(vehicle_models::class, 'vehicletype_vehiclemodels', 'vehicleModelId', 'vehicleTypeId');
    }
}

