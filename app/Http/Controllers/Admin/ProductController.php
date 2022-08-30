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

class ProductController extends Controller
{
    use File ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $table)
    {
        return $table->render('admin.products' , [
            'categories'=> Category::all()
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
        if ($request->ajax()){

            $newProduct = $request->validated();

            $success = Product::create($newProduct);

            //Upload image and insert to image table
            $this->upload_file(
                $request->file('image'),
                $request->name,
                $success->id // last inserted id
            );

            return response()->json(['message' => 'Product created successfully']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if ($request->ajax()){

            $newProduct = $request->validated();

            $product->update($newProduct);

            if($request->has('image')){
                //Upload image and insert to image table
                $this->upload_file(
                    $request->file('image'),
                    $request->name,
                    $product->id
                );
            }

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
        if (request()->ajax()){

            $product->delete();

            $image = Image::where('imageable_id' , $product->id );

            $image->delete();

            Storage::deleteDirectory("products/{$product->name}");

        }
    }
}
