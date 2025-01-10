<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefEvent extends Model
{
    use HasFactory;
    protected $table = 'ref_event';
    protected $guarded = [
        'id',
    ];
}
