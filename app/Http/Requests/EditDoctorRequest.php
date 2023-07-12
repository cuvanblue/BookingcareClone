<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDoctorRequest extends FormRequest
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
            'id' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'price' => 'required',
            'clinicid' => 'required',
            'career' => 'required',
            'specialize' => 'required',
            'degree' => 'required',
            'status' => 'required',
            'image' => 'mimes:png,jpg,jpeg,jfif|max:5120'
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Trang bị lỗi vui lòng thử lại',
            'email.required' => 'Email không hợp lệ',
            'address.required' => 'Địa chỉ không hợp lệ',
            'phone.required' => 'SĐT không hợp lệ',
            'phone.numeric' => 'SĐT không hợp lệ',
            'gender.required' => 'Giới tính không hợp lệ',
            'price.required' => 'Giá không hợp lệ',
            'clinicid.required' => 'Clinic ID không hợp lệ',
            'career.required' => 'Tiểu sử không hợp lệ',
            'specialize.required' => 'Chuyên môn không hợp lệ',
            'degree.required' => 'Học vị không hợp lệ',
            'status.required' => 'Trạng thái không hợp lệ',
            'image.mimes:png,jpg,jpeg,jfif' => 'Chỉ được upload file png, jpg, jpeg, jfif',
            'image.max:5120' => 'Ảnh phải nhỏ hơn 5mb'
        ];
    }
}