<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisbursementQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'disbursement_id',
        'disbursementable_id',
        'disbursementable_type',
        'amount',
        'status',
    ];

    public function disbursementable(): MorphTo
    {
        return $this->morphTo();
    }
}
