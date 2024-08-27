<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'policyTime',
        'chassis',
        'licensePlate',
        'year',
        'totalGeneral',
        'sellers_id',
        'car_tipe',
        'car_brand',
        'car_model',
        'client_id',
        'services',
        'payment_status',
        'tranf_number',
        'transaction_id',
        'transaction_ip',
        'discount_id',
        'payment_messeger',
        'auth_trans_ref_no',
        'police_transactionId',
        'police_number',
        'RemoteResponseCode',
        'AuthorizationCode',
        'policyInitDate',
        'RetrivalReferenceNumber',
        'TxToken',
        'imagenPoliza'
    ];

    protected $table = 'invoices';
    // public function client()
    // {
    //     return $this->belongsTo(Client::class, 'client_id');
    // }

    // public function brand()
    // {
    //     return $this->belongsTo(Vehicle_brands::class, 'car_brand');
    // }
}
