<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function vehicle_type_tarif()
    {
        return $this->hasMany(Vehicle_type_tarif::class);
    }
}
