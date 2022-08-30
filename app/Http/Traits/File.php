<?php

namespace App\Http\Traits ;

use App\Models\Image;

trait File {

    public function upload_file($file , $product_name , $product_id)
    {
        // for images
        $newImgName = time() . uniqid() . '.' . $file->getClientOriginalExtension() ;
        $file->storeAs('products/'.$product_name, $newImgName);

        // insert in image plymorph table
        // switch($request->method())
        Image::create([
            'name' => $newImgName ,
            'imageable_type'=> 'App\Models\Product',
            'imageable_id' => $product_id
        ]);

    }

}
