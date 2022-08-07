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

    public $cat_id ;

    // update view based on category select and clicked
    public function updateView($id)
    {
        $this->cat_id = $id ;
    }

    public function mount()
    {
        $this->categories = Category::where('parent' , 0)-> get();
    }

    public function render()
    {
        // we put the login here so we can use withPagination trait
        if(!$this->cat_id){
            $products = Product::paginate(5);
        }else{
            $products = Product::where('cat_id' , $this->cat_id)->paginate(2);
        }
        return view('livewire.shop.shop-component',['products' =>  $products]);
    }
}
