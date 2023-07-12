<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'required',
            'phone' => 'required|numeric',
            'image' => 'mimes:png,jpg,jpeg,jfif|max:5120'
        ];
    }
    public function messages()
    {
        return [
            'address.required' => 'Địa chỉ không hợp lệ',
            'phone.required' => 'SĐT không hợp lệ',
            'phone.numeric' => 'SĐT không hợp lệ',
            'image.mimes:png,jpg,jpeg,jfif' => 'Chỉ được upload file png, jpg, jpeg, jfif',
            'image.max:5120' => 'Ảnh phải nhỏ hơn 5mb'
        ];
    }
}