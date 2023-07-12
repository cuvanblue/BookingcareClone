<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddBookingGuestRequest extends FormRequest
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
            'doctorid' => 'required|numeric',
            'scheduleid' => 'required|numeric',
            'patientphone' => 'required|numeric',
            'patientname' => 'required',
            'patientbirthday' => 'required',
            'patientgender' => 'required',
            'patientaddress' => 'required',
            'patientdistrict' => 'required',
            'patientprovince' => 'required',
            'details' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'doctorid.required' => 'Bác sĩ không hợp lệ',
            'scheduleid.required' => 'Ca không hợp lệ',
            'patientphone.required' => 'Số điện thoại không hợp lệ',
            'patientphone.numeric' => 'Số điện thoại không hợp lệ',
            'patientname.required' => 'Tên không hợp lệ',
            'patientbirthday.required' => 'Ngày sinh không hợp lệ',
            'patientgender.required' => 'Giới tính không hợp lệ',
            'patientaddress.required' => 'Địa chỉ không hợp lệ',
            'patientdistrict.required' => 'Quận Huyện không hợp lệ',
            'patientprovince.required' => 'Tỉnh không hợp lệ',
            'details.required' => 'Chi tiết không hợp lệ',
        ];
    }
}