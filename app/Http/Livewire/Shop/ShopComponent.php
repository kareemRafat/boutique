<?php

namespace App\Http\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination ;

    public $childCategories = [] ;

    public $cat_id ;

    // update view based on category select and clicked
    public function updateView($id)
    {
        $this->cat_id = $id ;
        // $this->products = Product::where('cat_id' , $this->cat_id)->paginate(5);
    }

    public function mount()
    {

        $categories = Category::where('parent' , 0)-> get();

        $parent = $categories->toArray() ;
        for ($i=0; $i < count($parent); $i++) {
           $this->childCategories[$parent[$i]['name']] = Category::where('parent' , $parent[$i]['id'])-> get()->toArray() ;
        }

    }

    public function render()
    {
        if(!$this->cat_id){
            $products = Product::paginate(5);
        }else{

            $products = Product::where('cat_id' , $this->cat_id)->paginate(2);
        }
        return view('livewire.shop.shop-component',['products' =>  $products]);
    }
}
