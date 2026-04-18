<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class centeredModal extends Component
{
    public $title;
    public $width;

    public function __construct($title = 'Modal', $width = '300px')
    {
        $this->title = $title;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.centered-modal');
    }
}
