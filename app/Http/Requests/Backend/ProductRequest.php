<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $routeIdProduct = $this->route('product');
        return [
            'name' => 'required|string|min:3|unique:products,name,' . $routeIdProduct . ',uuid',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:available,unavailable',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/svg,image/jpg|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }
}
