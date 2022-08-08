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

    protected $queryString =['cat'];
    public $cat ;

    protected $listeners = [
        'reRenderProductComponent',
    ];

    public function reRenderProductComponent($id)
    {
        // user resetPage to remove page query string
        $this->resetPage();
        // put the cat id in cat query string
        $this->cat = $id ;
        $this->mount();
    }

    public function mount()
    {
        $this->categories = Category::where('parent' , 0)-> get();
    }

    public function render()
    {
        // we put the logic here so we can use withPagination trait
        if(!$this->cat){
            $products = Product::paginate(5);
        }else{
            $products = Product::where('cat_id' , $this->cat)->paginate(5);
        }
        return view('livewire.shop.product-component',['products' =>  $products]);
    }

}
