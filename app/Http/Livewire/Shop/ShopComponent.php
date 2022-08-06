<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;

class ShopComponent extends Component
{
    public $products ;

    public function mount()
    {
        $this->products = Product::all();
    }
    public function render()
    {
        return view('livewire.shop.shop-component');
    }
}
