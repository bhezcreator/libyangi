<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'theme_id',
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'type',
        'image',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'event_product');
    }
}
