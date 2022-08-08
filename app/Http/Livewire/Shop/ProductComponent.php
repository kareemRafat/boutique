<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination ;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'reRender',
    ];

    public function reRender()
    {
        $this->mount();
        $this->render();
    }

    public function mount()
    {
        $this->categories = Category::where('parent' , 0)-> get();
    }

    public function render()
    {
        // we put the login here so we can use withPagination trait
        if(!request()->cat){
            $products = Product::paginate(5);
        }else{
            $products = Product::where('cat_id' , request()->cat)->paginate(2);
        }
        return view('livewire.shop.product-component',['products' =>  $products]);
    }

}
