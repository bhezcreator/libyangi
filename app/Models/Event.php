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
        'concerne',
        'slug',
        'description',
        'start_date',
        'end_date',
        'type',
        'image',
        'status',
        'v_address',
        'v_programme',
        'v_detail_event',
        'v_livre',
        'v_infos_invite',
        'v_btn_valide',
        'v_date_debut',
        'v_date_fin',
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

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function programmes()
    {
        return $this->hasMany(Programmes::class);
    }

    public function controllers()
    {
        return $this->belongsToMany(
            User::class,
            'event_user'
        )->withTimestamps();
    }
}
