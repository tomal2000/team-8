<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disbursement extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'name',
        'amount',
        'status',
    ];

    public function disbursementQueues(): HasMany
    {
        return $this->hasMany(DisbursementQueue::class,'disbursement_id','id');
    }
}
