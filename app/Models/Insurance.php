<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
