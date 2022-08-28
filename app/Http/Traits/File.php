<?php

namespace App\Http\Traits ;

use App\Models\Image;

trait File {

    public function upload_file($file_name , $product_name , $last_id)
    {
        // for images
        $file = $file_name;
        $newImgName = time() . uniqid() . '.' . $file->getClientOriginalExtension() ;
        $file->storeAs('products/'.$product_name, $newImgName);

        // insert in image plymorph table
        Image::create([
            'name' => $newImgName ,
            'imageable_type'=> 'App\Models\Product',
            'imageable_id' => $last_id
        ]);

    }

}
