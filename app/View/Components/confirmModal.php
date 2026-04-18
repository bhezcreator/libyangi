<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class confirmModal extends Component
{
    public string $title;
    public string $message;
    public string $confirmText;
    public string $cancelText;
    public string $size;

    public function __construct(
        string $title = 'Confirmation',
        string $message = 'Êtes-vous sûr ?',
        string $confirmText = 'Confirmer',
        string $cancelText = 'Annuler',
        string $size = 'sm'
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->confirmText = $confirmText;
        $this->cancelText = $cancelText;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.confirm-modal');
    }
}
