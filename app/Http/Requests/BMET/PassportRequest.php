<?php

namespace App\Http\Requests\BMET;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PassportRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'passport_no' => 'required|alpha_num:ascii|max:10',
            'mobile' => 'required|digits:11',
            'passport_issue_date' => 'required|date',
            'full_name' => 'required|min:2|max:150',
            'passport_expiry_date' => 'required|date_before:passport_issue_date',
            'gender' => 'required|in:1,2',
            'dob' => 'required|date|is_adult',
            'district_id' => 'required|exists:districts,id',
            'passport_image'=>'nullable|max:2048|mimes:jpeg,jpg,png'
        ];
    }
}
