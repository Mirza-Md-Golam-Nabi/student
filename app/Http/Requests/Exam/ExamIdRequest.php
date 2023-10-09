<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamIdRequest extends FormRequest
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
            'exam' => [
                'required',
                'integer',
                Rule::exists('exam_infos', 'id')->where(function ($query) {
                    $query->where('root_id', rootId());
                }),
            ],
        ];
    }
}
