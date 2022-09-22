<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function insurace(){
        return $this->belongsTo(Insurance::class);
    }

    public function vehicle_type(){
        return $this->belongsTo(Vehicle_type_tarif::class);
    }
}
