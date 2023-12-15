<?php

namespace App\Http\Requests\BMET;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            'education' => 'required|array',
            'education.*.level' => 'required',
            'education.*.passing_year' => 'required',
            'education.*.institute' => 'required|string',
            'education.*.grade' => 'required|string',
            'education.*.board' => 'nullable|string',
            'education.*.subject' => 'nullable|string',
            'language' => 'required|array|min:1',
            'language.*.lang_name' => 'required|string',
            'language.*.oral' => 'required|in:Good,Native,Workable',
            'language.*.writing' => 'required|in:Good,Native,Workable',
            'desired_currency_id' => 'required|array',
            'preferred_job_category_id' => 'required|array'
        ];
    }
}
