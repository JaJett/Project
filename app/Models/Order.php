<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'pickup_date',
        'status',
        'total_price'];

    protected $casts = [
        'pickup_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
