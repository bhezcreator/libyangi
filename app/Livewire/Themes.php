<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Theme;

class Themes extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'custom';

    public $themeId;
    public $title;
    public $message_bg_color;
    public $page_bg_color;
    public $message_image;
    public $title_color;
    public $message_color;
    public $border_style;

    public $isEdit = false;
    public $showModalInterne = false;
    public $confirmingDelete = false;
    public $deleteId;
    public $search = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'message_bg_color' => 'required',
            'page_bg_color' => 'required',
            'title_color' => 'required',
            'message_color' => 'required',
            'border_style' => 'required',
            'message_image' => 'nullable|image|max:2048'
        ];
    }

    /* ========================
        RENDER
    ========================*/
    public function render()
    {
        $themes = Theme::where('title', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.themes', compact('themes'));
    }

    /* ========================
        RESET
    ========================*/
    public function resetForm()
    {
        $this->reset([
            'themeId',
            'title',
            'message_bg_color',
            'page_bg_color',
            'message_image',
            'title_color',
            'message_color',
            'border_style'
        ]);

        $this->isEdit = false;
    }

    /* ========================
        SAVE
    ========================*/
    public function save()
    {
        $this->validate();

        $imagePath = null;

        if ($this->message_image) {
            $imagePath = $this->message_image->store('themes', 'public');
        }

        Theme::updateOrCreate(
            ['id' => $this->themeId],
            [
                'title' => $this->title,
                'message_bg_color' => $this->message_bg_color,
                'page_bg_color' => $this->page_bg_color,
                'title_color' => $this->title_color,
                'message_color' => $this->message_color,
                'border_style' => $this->border_style,
                'message_image' => $imagePath ?? Theme::find($this->themeId)?->message_image,
            ]
        );

        $this->dispatch('toast',
            type: 'success',
            message: $this->isEdit ? 'Thème modifié' : 'Thème créé'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    public function edit($id)
    {
        $theme = Theme::findOrFail($id);

        $this->themeId = $theme->id;
        $this->title = $theme->title;
        $this->message_bg_color = $theme->message_bg_color;
        $this->page_bg_color = $theme->page_bg_color;
        $this->title_color = $theme->title_color;
        $this->message_color = $theme->message_color;
        $this->border_style = $theme->border_style;

        $this->isEdit = true;
        $this->showModalInterne = true;
    }

    public function create()
    {
        $this->resetForm();
        $this->showModalInterne = true;
    }

    /* ========================
        DELETE
    ========================*/
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function confirm()
    {
        Theme::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;

        $this->dispatch('toast',
            type: 'success',
            message: 'Thème supprimé'
        );
    }
}