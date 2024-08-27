<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'cardnumber',
        'passportnumber',
        'phonenumber',
        'province',
        'address',
        'city',
        'email',
        'nacionalidad',

    ];
    // public function invoice()
    // {
    //     return $this->hasMany(Invoices::class);
    // }
}
