<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_product');
    }
}
