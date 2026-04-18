<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'price', 'max_guests', 'features'];

    protected $casts = [
        'features' => 'array'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
