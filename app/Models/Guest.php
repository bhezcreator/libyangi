<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['event_id', 'code', 'name', 'phone', 'email', 'message', 'ip', 'status'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function checkin()
    {
        return $this->hasOne(Checkin::class);
    }
}
