<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductFamily;

class ProductFilter extends Component
{
    public $search = '';
    public $families = [];
    public $selectedFamily = null;
    public $brands = [];
    public $selectedBrand = null;
    public $minPrice = null;
    public $maxPrice = null;

    public function mount()
    {
        // Cargar todas las familias para el filtro
        $this->families = ProductFamily::pluck('family', 'id')->toArray();

        // Cargar marcas (si es campo texto)
        $this->brands = Product::select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->where('brand', '<>', '')
            ->orderBy('brand')
            ->pluck('brand')
            ->toArray();
    }

    public function render()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('product', 'like', "%{$this->search}%")
                ->orWhere('sku', 'like', "%{$this->search}%");
        }

        if ($this->selectedFamily) {
            $query->where('family_id', $this->selectedFamily);
        }

        if ($this->selectedBrand) {
            $query->where('brand', $this->selectedBrand);
        }

        if ($this->minPrice !== null) {
            $query->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice !== null) {
            $query->where('price', '<=', $this->maxPrice);
        }

        $products = $query->paginate(12);

        return view('livewire.product-filter', [
            'products' => $products,
        ]);
    }
}
