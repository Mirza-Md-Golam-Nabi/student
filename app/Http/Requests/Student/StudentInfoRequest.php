<?php

namespace App\Http\Requests\Student;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StudentInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return authUser()->isAllowed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'root_id' => 'required|integer',
            'name' => 'required|string|max:190',
            'class_id' => 'required|exists:cls,class_name_id',
            'father_name' => 'nullable|string|max:190',
            'mother_name' => 'nullable|string|max:190',
            'school_name' => 'nullable|string|max:190',
            'status' => 'sometimes|integer|in:0,1',
            'phone' => [
                'nullable',
                'digits:11',
                new PhoneNumber,
            ],
            'father_phone' => [
                'nullable',
                'digits:11',
                new PhoneNumber,
                'different:phone',
                'different:mother_phone',
            ],
            'mother_phone' => [
                'nullable',
                'digits:11',
                new PhoneNumber,
                'different:phone',
                'different:father_phone',
            ],
            'updated_by' => 'required|integer',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $root_id = rootId();
        $updated_by = auth()->id();

        $this->merge(
            compact('root_id', 'updated_by')
        );
    }
}
