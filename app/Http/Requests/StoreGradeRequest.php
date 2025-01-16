<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من السماح بهذا الطلب (يمكنك استخدام منطق الأذونات هنا إذا لزم الأمر)
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
            'Notes' => 'nullable|string',
        ];
    }

    /**
     * Customize the validation messages.
     */
    public function messages()
    {
        return [
            'Name.required' => 'The grade name is required.',
            'Name.array' => 'The grade name must be an array of translations.',
            'Name.en.required' => 'Each grade name.en translation is required.',
            'Name.ar.required' => 'Each grade name.ar translation is required.',
            'Name.en.string' => 'Each grade name.en translation must be a string.',
            'Name.ar.string' => 'Each grade name.ar translation must be a string.',
            'Notes.string' => 'The notes must be a string.',
        ];
    }
}
