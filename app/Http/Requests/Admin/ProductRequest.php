<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Validation\Rule;
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
        switch($this->method()) {

            case 'POST' :
                return [
                    'name' => 'required|min:4|max:20',
                    'price' => 'required|numeric',
                    'stock' => 'required|numeric',
                    'description' => 'required',
                    'cat_id' => 'required|numeric',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
                break ;

            case 'PUT' :
            case 'PATCH' :
                return [
                    'name' => 'required|min:4|max:20',
                    'price' => 'required|numeric',
                    'stock' => 'required|numeric',
                    'description' => 'required',
                    'cat_id' => 'required|numeric',
                    'image' =>
                        'image|
                         mimes:jpeg,png,jpg,gif,svg|
                         max:2048|
                         required_unless:name,'.Product::find($this->id)->name
                ];
                break;
        }

    }

    public function messages()
    {
        return [
            'image.required_unless' => 'image is required when name changes'
        ];
    }
}
