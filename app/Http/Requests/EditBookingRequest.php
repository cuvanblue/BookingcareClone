<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBookingRequest extends FormRequest
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
            'patientphone' => 'required|numeric',
            'details' => 'required',
            'status' => 'required',
            'file' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Trang bị lỗi vui lòng tải lại',
            'patientphone.required' => 'Số điện thoại không hợp lệ',
            'patientphone.numeric' => 'Số điện thoại không hợp lệ',
            'details.required' => 'Chi tiết không hợp lệ',
            'status.required' => 'Trạng thái không hợp lệ',
            'file.required' => 'Feedback không hợp lệ'
        ];
    }
}