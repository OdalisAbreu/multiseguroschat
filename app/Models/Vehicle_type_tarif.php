<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_type_tarif extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'veh_tipo',
        'tresmeses',
        'seismeses',
        'doceMeses',
        'activo'
    ];

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
