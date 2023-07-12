<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddBookingRequest extends FormRequest
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
            'doctorid' => 'required',
            'date' => 'required|after:' . Carbon::now(),
            'timeindex' => 'required',
            'patientemail' => 'required',
            'patientphone' => 'required|numeric',
            'patientname' => 'required',
            'patientbirthday' => 'required',
            'patientgender' => 'required',
            'patientaddress' => 'required',
            'patientdistrict' => 'required',
            'patientprovince' => 'required',
            'details' => 'required',
            'bookingstatus' => 'required',
            'file' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'doctorid.required' => 'Bác sĩ không hợp lệ',
            'date.required' => 'Ngày không hợp lệ',
            'date.after:' . Carbon::now() => 'Chỉ được đặt lịch khám cho những ngày hôm sau',
            'timeindex.required' => 'Ca khám không hợp lệ',
            'patientemail.required' => 'Email không hợp lệ',
            'patientphone.required' => 'Số điện thoại không hợp lệ',
            'patientphone.numeric' => 'Số điện thoại không hợp lệ',
            'patientname.required' => 'Tên không hợp lệ',
            'patientbirthday.required' => 'Ngày sinh không hợp lệ',
            'patientgender.required' => 'Giới tính không hợp lệ',
            'patientaddress.required' => 'Địa chỉ không hợp lệ',
            'patientdistrict.required' => 'Quận Huyện không hợp lệ',
            'patientprovince.required' => 'Tỉnh không hợp lệ',
            'details.required' => 'Chi tiết không hợp lệ',
            'bookingstatus.required' => 'Trạng thái không hợp lệ',
            'file.required' => 'Feedback không hợp lệ'
        ];
    }
}