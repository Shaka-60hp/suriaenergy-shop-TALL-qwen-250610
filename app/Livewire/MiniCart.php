<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class MiniCart extends Component
{
    public $items = [];
    public $totalItems = 0;
    public $totalPrice = 0;

    protected $listeners = ['add-to-cart' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->items = Session::get('cart', []);
        $this->totalItems = count($this->items);
        $this->totalPrice = collect($this->items)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.mini-cart');
    }
}
