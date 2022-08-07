<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class SubCategoryList extends Component
{
    // the subCateogies from the relation subcategory in Category model
    public $subCateoryList ;

    protected $queryString =['cat'];

    public $cat ;

    public function changeCat($id)
    {
        $this->cat = $id ;
        $this->emitUp('reRenderParent');
    }

    public function mount($cats)
    {
        $this->subCateoryList = $cats ;
    }
    public function render()
    {
        return view('livewire.shop.sub-category-list');
    }
}
