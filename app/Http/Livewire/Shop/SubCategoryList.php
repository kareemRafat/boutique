<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class SubCategoryList extends Component
{
    // the subCateogies from the relation subcategory in Category model
    public $subCateoryList ;

    public function mount($cats)
    {
        $this->subCateoryList = $cats ;
    }
    public function render()
    {
        return view('livewire.shop.sub-category-list');
    }
}
