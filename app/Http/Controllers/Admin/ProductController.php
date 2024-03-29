<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\File;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use App\DataTables\ProductsDataTable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;
use App\Mail\newAdminRegisterdMail;
use App\Mail\newProductAdded;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    use File;

    public function __construct() {
        // you need to confirm password to access products page
        $this->middleware('password.confirm');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $table)
    {
        return $table->render('admin.products', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if ($request->ajax()) {

            $newProduct = $request->validated();

            $newProduct = Product::create($newProduct);

            foreach($request->file('image') as $file){
                //Upload image and insert to image table
                $this->upload_file(
                    $file,
                    $newProduct // send the new product object
                );
            }

            $admin = Admin::find(1)->get() ;
            Mail::to($admin)->send(new newProductAdded($newProduct));

            return response()->json(['message' => 'Product created successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'desc' => $product->description,
            'images' => Image::where('imageable_id', $product->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($request->ajax()) {

            $newProduct = $request->validated();

            if($newProduct['name'] !== $request['old_name']){
                // dd(storage_path("products/{$request['old_name']}"));
                // dd(storage_path("products/{$newProduct['name']}"));

                Storage::move("products/{$request['old_name']}", "products/{$newProduct['name']}");
            }

            $product->update($newProduct);

            return response()->json(['message' => 'Product updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (request()->ajax()) {

            $product->delete();

            $image = Image::where('imageable_id', $product->id);

            $image->delete();

            Storage::deleteDirectory("products/{$product->name}");
        }
    }

    /**
     * Remove the specified image from storage and database.
     *
     */
    public function destroy_image(Product $product, Image $image)
    {

        // dd(Storage::delete("products/{$product->name}/{$image->name}"));
        // dd("products/{$product->name}/{$image->name}");
        // delete from image table and the storage folder
        $image->delete();
        Storage::delete("products/{$product->name}/{$image->name}");

        // check if the directory get empty after deleteing the image
        $folderFilesCount = count(Storage::files("products/{$product->name}"));
        if ($folderFilesCount == 0) {
            Storage::deleteDirectory("products/{$product->name}");
        }
    }

    public function update_image(Product $product , Request $request)
    {
        if($request->has('image')){
            $new_image = $this->upload_file(
                            $request->file('image'),
                            $product // send the product object
                        );

            return response()->json(['img'=>$new_image]);
        }
    }
}
