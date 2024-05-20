<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string','max:15','min:4'],
        ];
    }


    public function messages(): array
{
    return [
        'name.required' => 'A name is required',
        'name.string' => 'A name should string',
        'name.max' => 'A name maximum 15',
        'name.min' => 'A name minmum 4',
    ];
}
}
