<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'id',
            'user_id',
            'receiver_name' => [
                'required',
                'regex:/^[A-EG-IK-VXYÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬẸẺẼÈÉÊỀẾỂỄỆÌÍỈỊĨÒÓỌỎÕÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦĐƯỨỪỬỮỰỲỴÝỶỸ][a-eg-ik-vxyàáảãạăắằẳẵặâấầẩẫậẹẻẽèéêềếểễệìíỉịĩòóọỏõôốồổỗộơớờởỡợùúũụủđưứừửữựỳỵýỷỹ]{0,6}(?: [A-EG-IK-VXYÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬẸẺẼÈÉÊỀẾỂỄỆÌÍỈỊĨÒÓỌỎÕÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦĐƯỨỪỬỮỰỲỴÝỶỸ][a-eg-ik-vxyàáảãạăắằẳẵặâấầẩẫậẹẻẽèéêềếểễệìíỉịĩòóọỏõôốồổỗộơớờởỡợùúũụủđưứừửữựỳỵýỷỹ]{0,6}){0,8}$/',
            ],
            'receiver_phone' => [
                'required',
                'regex:/^(((\+|)84)|0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/',
            ],
            'receiver_email' => [
                'required',
                'email',
            ],
            'receiver_province' => [
                'required',
                'integer',
            ],
            'receiver_district' => [
                'required',
                'integer',
            ],
            'receiver_ward' => [
                'required',
                'integer',
            ],
            'receiver_address' => 'required',
            'total',
            'payment' => [
                'required',
                'string',
            ]
        ];
    }

    public function attributes()
    {
        return [
            'receiver_name' => 'Họ tên người nhận',
            'receiver_phone' => 'Số điện thoại người nhận',
            'receiver_email' => 'Email người nhận',
            'receiver_province' => 'Tỉnh/thành người nhận',
            'receiver_district' => 'Quận/huyện người nhận',
            'receiver_ward' => 'Xã/phường người nhận',
            'receiver_address' => 'Địa chỉ cụ thể người nhận',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'regex' => ':attribute không đúng định dạng',
            'integer' => ':attribute không đúng định dạng',
            'email' => ':attribute không đúng định dạng',
            'string' => ':attribute không đúng định dạng',
        ];
    }
}
