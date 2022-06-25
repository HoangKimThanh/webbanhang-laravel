<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateAdminRequest extends FormRequest
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
            'oldPassword' => [
                'required',
            ],
            'newPassword' => 'required',
            'newPasswordConfirm' => [
                'required',
                'same:newPassword',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'oldPassword' => 'Mật khẩu hiện tại',
            'newPassword' => 'Mật khẩu mới',
            'newPasswordConfirm' => 'Mật khẩu nhập lại',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'same' => ':attribute không đúng',
        ];
    }
}
