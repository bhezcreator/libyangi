<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Request extends Model implements HasMedia
{
    protected $fillable = ['user_id', 'subscription_id', 'status', 'description'];
    use InteractsWithMedia;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mediase()
    {
        return $this->hasMany(RequestMedia::class);
    }

    public function subscription()
    {
        return $this->belongsTo(\App\Models\Subscription::class);
    }
}
