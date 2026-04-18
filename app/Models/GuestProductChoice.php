<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestProductChoice extends Model
{
    protected $fillable = [
        'guest_id',
        'product_id',
        'event_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
