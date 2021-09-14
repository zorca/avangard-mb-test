<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Order extends Model
{

    protected $casts = ['total_cost' => 'integer'];

    protected $appends = ['total_cost', 'human_status'];

    public function getTotalCostAttribute(): int
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->cost;
        }
        return $total;
    }

    public function getHumanStatusAttribute(): string
    {
        $statuses = [
            0 => 'новый',
            10 => 'подтверждён',
            20 => 'завершён',
        ];
        return $statuses[$this->status];
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
