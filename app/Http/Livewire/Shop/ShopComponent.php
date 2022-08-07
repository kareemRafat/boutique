<?php

namespace App\Http\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination ;

    public $categories ;

    public function mount()
    {
        $this->categories = Category::where('parent' , 0)-> get();

    }

    protected $listeners = [
        'reRenderParent'=>'$refresh',
    ];

    public function render()
    {
        return view('livewire.shop.shop-component');
    }
}
