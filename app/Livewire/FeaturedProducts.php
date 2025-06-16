<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class FeaturedProducts extends Component
{
    public $topSelling = [];
    public $newest = [];
    public $onSale = [];

    public function mount()
    {
        // Más vendidos: Cargar los IDs primero para evitar LIMIT en subquery
        $topProductIds = DB::table('order_items')
            ->select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('SUM(qty) DESC')
            ->limit(6)
            ->pluck('product_id');

        $this->topSelling = Product::whereIn('id', $topProductIds)->get();

        // Productos nuevos (últimos agregados)
        $this->newest = Product::latest()->take(6)->get();

        // Productos en oferta (campo 'discount' o similar)
        $this->onSale = Product::where('price', '<', 50)->take(6)->get(); // Cambia por tu lógica real de ofertas
    }

    public function render()
    {
        return view('livewire.featured-products', [
            'topSelling' => $this->topSelling,
            'newest' => $this->newest,
            'onSale' => $this->onSale,
        ]);
    }
}
