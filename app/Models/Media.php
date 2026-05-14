<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Media extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'medias';

    protected $fillable = [
        'event_id',
        'type',
        'visibility',
    ];

    public function files()
    {
        return $this->morphMany(
            \Spatie\MediaLibrary\MediaCollections\Models\Media::class,
            'model'
        );
    }

    public function getFileUrlAttribute()
    {
        return $this->getFirstMediaUrl('images') ?: null;
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('public');
    }
}
