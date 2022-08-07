<?php

namespace App\Http\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ShopComponent extends Component
{
    public $products ;

    public $childCategories = [] ;

    public $cat_id ;

    public function updateView($id)
    {
        $this->cat_id = $id ;
    }

    public function mount()
    {

        $this->products = Product::all();

        $categories = Category::where('parent' , 0)-> get();

        $parent = $categories->toArray() ;
        for ($i=0; $i < count($parent); $i++) {
           $this->childCategories[$parent[$i]['name']] = Category::where('parent' , $parent[$i]['id'])-> get()->toArray() ;
        }

    }

    public function hydrate()
    {
        $this->products = Product::where('cat_id' , $this->cat_id)->get();
    }

    public function render()
    {
        return view('livewire.shop.shop-component');
    }
}
