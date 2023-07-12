<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddClinicRequest extends FormRequest
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
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'introduce' => 'required',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không hợp lệ',
            'fullname.required' => 'Tên không hợp lệ',
            'email.required' => 'Email không hợp lệ',
            'address.required' => 'Địa chỉ không hợp lệ',
            'introduce.required' => 'Giới thiệu không hợp lệ',
            'status.required' => 'Trạng thái không hợp lệ',
        ];
    }
}