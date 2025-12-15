<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'payment_type_id',
        'name',
        'total_price',
        'total_paid',
        'total_return',
        'receipt_code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_type_id');
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
