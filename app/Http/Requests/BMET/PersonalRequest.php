<?php

namespace App\Http\Requests\BMET;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
            'expat_id' => 'required|integer',
            'religion_id' => 'required|exists:religions,id',
            'fathers_name' => 'required|string',
            'mothers_name' => 'required|string',
            'marital_status' => 'required',
            'height_feet' => 'required|integer',
            'weight' => 'required|integer',
            'height_inch' => 'required|integer',
            'spouse_name' => 'nullable|max:150'

        ];
    }
}
