<?php

namespace App\Http\Requests\BMET;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'permanent_district_id' => 'required|exists:districts,id',
            'permanent_upazilla_id' => 'required|exists:upazillas,id',
            'relation_id' => 'required|exists:relations,id',
            'permanent_union' => 'required|string',
            'permanent_village' => 'required|string',
            'permanent_house' => 'required|string',
            'same_as' => 'nullable',
            'mailing_district_id' => [
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'exists:districts,id',
            ],
            'mailing_upazilla_id' => [
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'exists:upazillas,id',
            ],
            'mailing_union' => [
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'string',
            ],
            'mailing_village' => [
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'string',
            ],
            'mailing_house' => [Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'string',
            ],
            'emergency_contact_person_name' => 'required|string',
            'emergency_contact_person_phone' => 'required|digits:11',
        ];
    }
}
