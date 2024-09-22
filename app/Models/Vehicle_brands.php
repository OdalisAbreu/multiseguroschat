<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_brands extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'ID',
        'DESCRIPCION',
        'cod_marca',
        'activo'
    ];
    protected $table = 'vehicle_brands';

    public function invoices()
    {
        return $this->hasMany(Invoices::class, 'car_brand', 'ID');
    }
}
