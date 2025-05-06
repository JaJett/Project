<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
        public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
