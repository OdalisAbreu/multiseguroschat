<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'prefijo',
        'id_suplid',
        'logo',
        'color',
        'note_cobertura',
        'activo',
        'valores_alternos'
    ];


    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
