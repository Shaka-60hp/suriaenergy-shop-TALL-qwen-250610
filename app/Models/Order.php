<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'contact_id',
        'seller_id',
        'order_type',
        'currency_id',
        'order_total',
        'date',
        'delivery_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
