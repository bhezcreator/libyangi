<?php

namespace App\Livewire\Event;

use App\Models\Media;
use Livewire\Component;

class MediaPicturePublic extends Component
{

    public Int $event_id;
    public $search = '';

    public function mount(Int $event_id)
    {
        $this->event_id = $event_id;
    }

    public function render()
    {
        $medias = Media::where(
            'event_id',
            $this->event_id
        )->where('visibility', 'public')
            ->where(function ($query) {
                $query
                    ->where(
                        'type',
                        'like',
                        "%{$this->search}%"
                    );
            })
            ->get();
        return view(
            'livewire.event.media-picture-public',
            compact('medias')
        );
    }
}
