<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedClient extends Model
{
    protected $table = 'blocked_client';

    use HasFactory;
}
