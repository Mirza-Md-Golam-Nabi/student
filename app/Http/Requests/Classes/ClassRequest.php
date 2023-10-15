<?php

namespace App\Http\Requests\Classes;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
{
    protected $errorBag = 'default';

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
            'class_name_id' => 'required|exists:class_names,id',
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        if ($this->method() == 'POST') {
            $this->errorBag = 'store';
        } elseif ($this->method() == 'PUT') {
            $this->errorBag = 'update';
        }

        return $validator;
    }
}
