<?php

namespace App\Http\Requests\Classes;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClassIdRequest extends FormRequest
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
            'class' => [
                'required',
                'integer',
                Rule::exists('cls', 'class_name_id')->where(function ($query) {
                    $query->where('root_id', rootId());
                }),
            ],
        ];
    }
}
