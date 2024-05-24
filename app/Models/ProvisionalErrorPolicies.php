<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvisionalErrorPolicies extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'petition',
        'error',
    ];
    public function invoice()
    {
        return $this->belongsTo(Invoices::class);
    }
}
