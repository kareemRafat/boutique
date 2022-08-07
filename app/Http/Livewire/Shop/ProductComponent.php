<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination ;

    public $catId ;

    public function mount()
    {
        $this->categories = Category::where('parent' , 0)-> get();
        $this->catId = request()->cat ;
    }

    public function render()
    {
        // we put the login here so we can use withPagination trait
        if(!$this->catId){
            $products = Product::paginate(5);
        }else{
            $products = Product::where('cat_id' , $this->catId)->paginate(2);
        }
        return view('livewire.shop.product-component',['products' =>  $products]);
    }

}
