<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_models extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'ID',
        'descripcion',
        'IDMARCA',
        'cod_modelo',
        'activo'
    ];
    protected $table = 'vehicle_models';

    public function invoices()
    {
        return $this->hasMany(Invoices::class, 'car_model', 'ID');
    }
}
