<?php

namespace App\Http\Traits;

use App\Models\Image;

trait File
{

    public $file;
    public $product;

    public function upload_file($file, $product)
    {

        $this->file = $file;
        $this->product = $product;

        $newImgName = $this->storeImg();

        // insert in image plymorph table
        $new_image = Image::create([
            'name' => $newImgName,
            'imageable_type' => 'App\Models\Product',
            'imageable_id' => $this->product->id,
            'path' => "storage/products/{$this->product->name}/{$newImgName}"
        ]);

        return $new_image;
    }

    public function storeImg()
    {
        // for images
        $name = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
        $newImgName = $name . time() . '.' . $this->file->getClientOriginalExtension();
        $this->file->storeAs('products/' . $this->product->name, $newImgName);

        return $newImgName;
    }
}
