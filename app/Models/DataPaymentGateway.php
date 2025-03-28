<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaymentGateway extends Model
{
    use HasFactory;

    protected $table = 'data_payment_gateway';
    protected $fillable = [
        'merchanttype',
        'merchantnumber',
        'merchantterminal',
        'client_name',
        'insurance_id',
        'payment_gateway_id',
        'payment_url'
    ];
}
