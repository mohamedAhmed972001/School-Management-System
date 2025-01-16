<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // السماح بهذا الطلب (يمكنك تخصيص منطق الأذونات إذا لزم الأمر)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Name' => 'required|array',
            'Name.en' => 'required|string',
            'Name.ar' => 'required|string',
            'Status' => 'nullable|boolean',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id'
        ];
    }


    /**
     * Customize the validation messages.
     */
    public function messages()
    {
        return [
            'Name.required' => 'The section name is required.',
            'Name.array' => 'The section name must be an array.',
            'Name.en.required' => 'The English name is required.',
            'Name.en.string' => 'The English name must be a string.',
            'Name.ar.required' => 'The Arabic name is required.',
            'Name.ar.string' => 'The Arabic name must be a string.',
            'Status.nullable' => 'The section status is optional.',
            'Status.boolean' => 'The section status must be a boolean value (1 or 0).',
            'Grade_id.required' => 'The grade ID is required.',
            'Grade_id.exists' => 'The selected grade ID is invalid.',
            'Classroom_id.required' => 'The classroom ID is required.',
            'Classroom_id.exists' => 'The selected classroom ID is invalid.',
        ];

    }
}
