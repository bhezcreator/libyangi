<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'title',
        'message_bg_color',
        'page_bg_color',
        'message_image',
        'title_color',
        'message_color',
        'border_style',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
