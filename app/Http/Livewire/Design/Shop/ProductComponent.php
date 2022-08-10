<?php

namespace App\Http\Livewire\Design\Shop;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination ;
    protected $paginationTheme = 'bootstrap';

    protected $queryString =['cat'];
    public $cat ; // for adding values to querstring

    public $sorting ;// for sorting select box

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

            if($this->sorting == 'low-high') {
                $products = Product::orderBy('price')->paginate(5);
            }elseif($this->sorting == 'high-low'){
                $products = Product::orderByDesc('price')->paginate(5);
            }else{
                $products = Product::paginate(5);
            }

        }else{

            if($this->sorting == 'low-high') {
                $products = Product::where('cat_id' , $this->cat)->orderBy('price')->paginate(5);
            }elseif($this->sorting == 'high-low'){
                $products = Product::where('cat_id' , $this->cat)->orderByDesc('price')->paginate(5);
            }else{
                $products = Product::where('cat_id' , $this->cat)->paginate(5);
            }

        }

        return view('livewire.design.shop.product-component',['products' =>  $products]);
    }

}
