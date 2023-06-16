<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamInfoRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'subject_id' => [
                'required',
                'integer',
                Rule::exists('subjects', 'id')->where(function ($query) {
                    $query->where('root_id', rootId());
                }),
            ],
            'class_id' => [
                'required',
                'integer',
                Rule::exists('cls', 'class_name_id')->where(function ($query) {
                    $query->where('root_id', rootId());
                }),
            ],
            'total_marks' => 'required|numeric',
            'topic' => 'nullable|string|max:65530',
            'exam_date' => 'required|date_format:Y-m-d',
            'status' => 'sometimes|integer|in:0,1',
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

        $this->merge(
            compact('root_id')
        );
    }
}
