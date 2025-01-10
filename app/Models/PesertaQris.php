<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaQris extends Model
{
    use HasFactory;
    protected $table = 'peserta_qris';
    protected $guarded = [
        'id',
    ];
}
