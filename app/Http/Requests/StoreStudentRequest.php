<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'Name' => 'required|array',
            'Name.ar' => 'required|string|max:255',
            'Name.en' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'Gender_id' => 'required|exists:genders,id',
            'Nationality_id' => 'required|exists:nationalities,id',
            'Date_Birth' => 'required|date',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'Section_id' => 'required|exists:sections,id',
            'Parent_id' => 'required|exists:myparents,id',
            'Religion_id' => 'required|exists:religions,id',  // إضافة قاعدة التحقق لـ Religion_id
            'Academic_Year' => 'required|string|max:20',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'Name.array' => 'The student name must be an array of translations.',
            'Name.ar.required' => 'The name in Arabic is required.',
            'Name.en.required' => 'The name in English is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'Gender_id.required' => 'The gender ID is required.',
            'Gender_id.exists' => 'The selected gender is invalid.',
            'Nationality_id.required' => 'The nationality ID is required.',
            'Nationality_id.exists' => 'The selected nationality is invalid.',
            'Date_Birth.required' => 'The date of birth is required.',
            'Grade_id.required' => 'The grade ID is required.',
            'Grade_id.exists' => 'The selected grade is invalid.',
            'Classroom_id.required' => 'The classroom ID is required.',
            'Classroom_id.exists' => 'The selected classroom is invalid.',
            'Section_id.required' => 'The section ID is required.',
            'Section_id.exists' => 'The selected section is invalid.',
            'Parent_id.required' => 'The parent ID is required.',
            'Parent_id.exists' => 'The selected parent is invalid.',
            'Religion_id.required' => 'The religion ID is required.',  // رسالة الخطأ لـ Religion_id
            'Religion_id.exists' => 'The selected religion is invalid.', // رسالة الخطأ لـ Religion_id
            'Academic_Year.required' => 'The academic year is required.',
        ];
    }
}
