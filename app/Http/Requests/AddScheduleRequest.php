<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddScheduleRequest extends FormRequest
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
            'date' => 'required|date|after_or_equal:' . Carbon::tomorrow(),
            'timeindex' => 'required',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'doctorid.required' => 'Bác sĩ không hợp lệ',
            'date.required' => 'Ngày không hợp lệ',
            'date.date' => 'Ngày không hợp lệ',
            'date.after_or_equal:' . Carbon::tomorrow() => 'Chỉ được sửa lịch của ngày mai',
            'timeindex.required' => 'Ca không hợp lệ',
            'status.required' => 'Trạng thái không hợp lệ',
        ];
    }
}