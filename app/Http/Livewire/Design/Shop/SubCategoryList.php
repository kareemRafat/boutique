<?php

namespace App\Http\Livewire\Design\Shop;

use App\Models\Product;
use Livewire\Component;

class SubCategoryList extends Component
{
    // the subCateogies from the relation subcategory in Category model
    public $subCateoryList ;
    public $counter ;

    protected $queryString =['cat'];
    public $cat ; // this a query string param

    public function changeCat($id)
    {
        if(!$this->productCount($id)) return false  ;

        $this->cat = $id ;
        $this->emit('reRenderProductComponent', $id);// send the cat id to the ProductComponent

    }

    public function productCount($cat_id)
    {
        // check if the category has products of not

        return Product::where('cat_id',$cat_id)->count() > 0 ?: false ;
        // this will return true if the condition true or return false
    }

    public function mount($cats)
    {
        $this->subCateoryList = $cats ;
    }
    public function render()
    {
        return view('livewire.design.shop.sub-category-list');
    }
}
