<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','stock','description','cat_id'];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class , 'cat_id');
    }

    public function getProStockAttribute()
    {
        // call it with $product->pro_stock ;
        return $this->stock == 0 ? "<span class='badge badge-secondary p-2 shadow-sm'>Empty</span>" : "<span class='badge badge-light p-2 shadow-sm'>{$this->stock}</span>"  ;
    }
}
