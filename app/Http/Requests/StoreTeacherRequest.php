<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|string|min:6',
            'Name.array' => 'The Name must be an array of translations.',
            'Name.en' => 'required|string|max:255', // English translation
            'Name.ar' => 'required|string|max:255', // Arabic translation
            'Specialization_id' => 'required|exists:specializations,id',
            'Gender_id' => 'required|exists:genders,id',
            'Joining_Date' => 'required|date',
            'Address' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email is required.',
            'email.email' => 'The email format is invalid.',
            'email.unique' => 'The email is already taken.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'Name.en.required' => 'The English name is required.',
            'Name.ar.required' => 'The Arabic name is required.',
            'Specialization_id.required' => 'The specialization is required.',
            'Specialization_id.exists' => 'The selected specialization is invalid.',
            'Gender_id.required' => 'The gender is required.',
            'Gender_id.exists' => 'The selected gender is invalid.',
            'Joining_Date.required' => 'The joining date is required.',
            'Address.required' => 'The address is required.',
            'Address.max' => 'The address must not exceed 255 characters.',
        ];
    }
}
