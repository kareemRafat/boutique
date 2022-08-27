<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        // use this to know if i add a new product or update a product

        $pro_id = $this->segment(2); //[get the product id]

        switch ($pro_id) {
            case 'null':
                return [
                    'name' => 'required|min:4|max:20',
                    'price' => 'required|numeric',
                    'stock' => 'required|numeric',
                    'description' => 'required',
                    'cat_id' => 'required|numeric',
                ];
                break;

            case $pro_id:

                return [
                    'name' => 'required|min:4|max:10',
                    'price' => 'required|numeric',
                    'stock' => 'required|numeric',
                    'description' => 'required',
                    'cat_id' => 'required|numeric',
                ];
                break;
        }
    }
}
