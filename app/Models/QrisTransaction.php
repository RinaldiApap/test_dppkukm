<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrisTransaction extends Model
{
    use HasFactory;
    protected $table = 'qris_transaction';
    protected $guarded = [
        'id',
    ];
}
