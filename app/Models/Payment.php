<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    //

    protected $fillable = [
        'name',
        'type',
        'logo',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
