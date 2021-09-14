<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $appends = ['cost'];

    public function getNameAttribute()
    {
        return $this->product->name;
    }

    public function getCostAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
