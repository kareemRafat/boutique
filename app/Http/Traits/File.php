<?php

namespace App\Http\Traits ;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait File {

    public $file ;
    public $product ;

    public function upload_file($file , $product)
    {

        $this->file = $file ;
        $this->product = $product ;

        if (request()->method() == "POST") {

            $this -> createImg();

        } elseif (request()->method() == "PUT") {

            $this->updateImg();
        }
    }

    public function createImg()
    {

        $newImgName = $this->storeImg();

        // insert in image plymorph table
        Image::create([
            'name' => $newImgName ,
            'imageable_type'=> 'App\Models\Product',
            'imageable_id' => $this->product->id
        ]);
    }

    public function updateImg()
    {
        // delete the old image when update from disk
        Storage::disk('public')->delete("products/{$this->product->name}/{$this->product->image->name}");

        $newImgName = $this->storeImg();

        // update in image plymorph table
        $this->product->image->update([
            'name' => $newImgName ,
            'imageable_type'=> 'App\Models\Product',
            'imageable_id' => $this->product->id
        ]);
    }


    public function storeImg()
    {
        // for images
        $newImgName = time() . uniqid() . '.' . $this->file->getClientOriginalExtension() ;
        $this->file->storeAs('products/'.$this->product->name, $newImgName);

        return $newImgName ;
    }





}
