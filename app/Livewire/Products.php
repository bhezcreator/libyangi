<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Products extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $productId;
    public $name;
    public $category;

    public $isEdit = false;
    public $showModalInterne = false;
    public $confirmingDelete = false;
    public $deleteId;

    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ];
    }

    /* ========================
        RENDER
    ========================*/
    public function render()
    {
        $products = Product::where('name', 'like', "%{$this->search}%")
            ->orWhere('category', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.products', compact('products'));
    }

    /* ========================
        RESET
    ========================*/
    public function resetForm()
    {
        $this->reset([
            'productId',
            'name',
            'category',
        ]);

        $this->isEdit = false;
    }

    /* ========================
        CREATE / UPDATE
    ========================*/
    public function save()
    {
        $this->validate();

        Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'category' => $this->category,
            ]
        );

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->isEdit ? 'Produit modifié' : 'Produit créé'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;

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
        Product::findOrFail($this->deleteId)->delete();

        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Produit supprimé'
        );
    }
}
