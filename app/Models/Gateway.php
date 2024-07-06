<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'name',
        'fee_type',
        'fee',
        'logo',
        'is_active',
        'meta',
        'is_confirmed'
    ];
}
