<?php

namespace App\Http\Requests\BMET;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NomineeRequest extends FormRequest
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
            'nominee_relation_id' => 'required|exists:relations,id',
            'nominee_name' => 'required|string',
            'nominee_nid' => 'nullable|string|min:10|max:17',
            'nominee_phone' => 'required|string|min:11|max:11',
            'nominee_fathers_name' => 'required|string',
            'nominee_mothers_name' => 'required|string',
            'same_as' => 'nullable',
            'nominee_district_id'=>[
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'exists:districts,id',
            ],
            'nominee_upazilla_id'=>[
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'exists:upazillas,id',
            ],
            'nominee_union'=> [
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'string',
            ],
            'nominee_village'=>[
                Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'string',
            ],
            'nominee_house'=>[Rule::requiredIf(function () {
                    return $this->same_as != 1;
                }), 'nullable', 'string',
            ],
        ];
    }
}
