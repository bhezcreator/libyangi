<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'event_id',
        'address',
        'latitude',
        'longitude',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
