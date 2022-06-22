<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            Rule::unique('products', 'name')->ignore($this->product),
            'detail' => 'required',
            'description' => 'required',
            'old_price' => [
                'bail',
                'required',
                'integer',
            ],
            'new_price' => [
                'bail',
                'nullable',
                'integer',
                'lt:old_price'  
            ],
            'image_main' => 'nullable|image',
            'images_description' => 'nullable',
            'images_description.*' => 'nullable|image',
            'featured' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'Tên danh mục',
            'name' => 'Tên sản phẩm',
            'detail' => 'Chi tiết sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'old_price' => 'Giá sản phẩm',
            'image_main' => 'Ảnh sản phẩm',
            'images_description' => 'Ảnh mô tả sản phẩm',
            'images_description.*' => 'Ảnh mô tả sản phẩm',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'integer' => ':attribute phải là số',
            'image' => ':attribute phải là file ảnh',
            'unique' => ':attribute đã tồn tại',
            'lt' => ':attribute phải nhỏ hơn giá sản phẩm',
        ];
    }
}
