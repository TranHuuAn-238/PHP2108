<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLoginRequest extends FormRequest
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
     * Get the validation rules that apply to the request. Thiết lập lỗi
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emailUser' => 'required|email',
            'passwordUser' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules. Tạo thông báo lỗi
     *
     * @return array
     */
    public function messages()
    {
        return [
            'emailUser.required' => ':attribute không được để trống',
            'emailUser.email' => ':attribute phải là định dạng email',
            'passwordUser.required' => ':attribute không được để trống'
        ];
    }
}
