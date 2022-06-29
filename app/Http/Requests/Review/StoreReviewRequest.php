<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'product_id' => [
                'required',
                'integer',
            ],
            'user_name' => [
                'required',
                'regex:/^[A-EG-IK-VXYÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬẸẺẼÈÉÊỀẾỂỄỆÌÍỈỊĨÒÓỌỎÕÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦĐƯỨỪỬỮỰỲỴÝỶỸ][a-eg-ik-vxyàáảãạăắằẳẵặâấầẩẫậẹẻẽèéêềếểễệìíỉịĩòóọỏõôốồổỗộơớờởỡợùúũụủđưứừửữựỳỵýỷỹ]{0,6}(?: [A-EG-IK-VXYÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬẸẺẼÈÉÊỀẾỂỄỆÌÍỈỊĨÒÓỌỎÕÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦĐƯỨỪỬỮỰỲỴÝỶỸ][a-eg-ik-vxyàáảãạăắằẳẵặâấầẩẫậẹẻẽèéêềếểễệìíỉịĩòóọỏõôốồổỗộơớờởỡợùúũụủđưứừửữựỳỵýỷỹ]{0,6}){0,8}$/',
            ],
            'user_email' => [
                'required',
                'email',
            ],
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => 'Sản phẩm',
            'name' => 'Họ tên',
            'email' => 'Email',
            'content' => 'Nội dung đánh giá',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải có',
            'regex' => ':attribute không đúng định dạng',
            'integer' => ':attribute không đúng định dạng',
            'email' => ':attribute không đúng định dạng',
        ];
    }
}
