<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMyParentRequest extends FormRequest
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
            'email' => 'required|email|unique:MyParents,email',
            'password' => 'required|string|min:6',

            // الأعمدة المترجمة
            'Name_Father.array' => 'The Name_Father name must be an array of translations',
            'Name_Father.en' => 'required|string|max:255', // التحقق من الترجمة الإنجليزية
            'Name_Father.ar' => 'required|string|max:255', // التحقق من الترجمة العربية

            'Job_Father.array' => 'The Job_Father name must be an array of translations.',
            'Job_Father.en' => 'required|string|max:255', // التحقق من الترجمة الإنجليزية
            'Job_Father.ar' => 'required|string|max:255', // التحقق من الترجمة العربية

            'Name_Mother.array' => 'The Name_Mother name must be an array of translations.',
            'Name_Mother.en' => 'required|string|max:255', // التحقق من الترجمة الإنجليزية
            'Name_Mother.ar' => 'required|string|max:255', // التحقق من الترجمة العربية

            'Job_Mother.array' => 'The Job_Mother name must be an array of translations.',
            'Job_Mother.en' => 'required|string|max:255', // التحقق من الترجمة الإنجليزية
            'Job_Mother.ar' => 'required|string|max:255', // التحقق من الترجمة العربية

            'National_ID_Father' => 'required|string|max:20|unique:MyParents',
            'Passport_ID_Father' => 'nullable|string|max:20|unique:MyParents',
            'Phone_Father' => 'required|string|max:15',
            'Nationality_Father_id' => 'required|exists:nationalities,id',
            'Religion_Father_id' => 'required|exists:religions,id',
            'Address_Father' => 'required|string|max:255',

            'National_ID_Mother' => 'required|string|max:20|unique:MyParents',
            'Passport_ID_Mother' => 'nullable|string|max:20|unique:MyParents',
            'Phone_Mother' => 'required|string|max:15',
            'Nationality_Mother_id' => 'required|exists:nationalities,id',
            'Religion_Mother_id' => 'required|exists:religions,id',
            'Address_Mother' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address is already taken.',

            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 6 characters long.',

            // الأعمدة المترجمة
            'Name_Father.array' => 'The Name_Father must be an array of translations.',
            'Name_Father.en.required' => 'The English Name of the father is required.',
            'Name_Father.en.string' => 'The English Name of the father must be a string.',
            'Name_Father.en.max' => 'The English Name of the father cannot exceed 255 characters.',
            'Name_Father.ar.required' => 'The Arabic Name of the father is required.',
            'Name_Father.ar.string' => 'The Arabic Name of the father must be a string.',
            'Name_Father.ar.max' => 'The Arabic Name of the father cannot exceed 255 characters.',

            'Job_Father.array' => 'The Job_Father must be an array of translations.',
            'Job_Father.en.required' => 'The English Job of the father is required.',
            'Job_Father.en.string' => 'The English Job of the father must be a string.',
            'Job_Father.en.max' => 'The English Job of the father cannot exceed 255 characters.',
            'Job_Father.ar.required' => 'The Arabic Job of the father is required.',
            'Job_Father.ar.string' => 'The Arabic Job of the father must be a string.',
            'Job_Father.ar.max' => 'The Arabic Job of the father cannot exceed 255 characters.',

            'Name_Mother.array' => 'The Name_Mother must be an array of translations.',
            'Name_Mother.en.required' => 'The English Name of the mother is required.',
            'Name_Mother.en.string' => 'The English Name of the mother must be a string.',
            'Name_Mother.en.max' => 'The English Name of the mother cannot exceed 255 characters.',
            'Name_Mother.ar.required' => 'The Arabic Name of the mother is required.',
            'Name_Mother.ar.string' => 'The Arabic Name of the mother must be a string.',
            'Name_Mother.ar.max' => 'The Arabic Name of the mother cannot exceed 255 characters.',

            'Job_Mother.array' => 'The Job_Mother must be an array of translations.',
            'Job_Mother.en.required' => 'The English Job of the mother is required.',
            'Job_Mother.en.string' => 'The English Job of the mother must be a string.',
            'Job_Mother.en.max' => 'The English Job of the mother cannot exceed 255 characters.',
            'Job_Mother.ar.required' => 'The Arabic Job of the mother is required.',
            'Job_Mother.ar.string' => 'The Arabic Job of the mother must be a string.',
            'Job_Mother.ar.max' => 'The Arabic Job of the mother cannot exceed 255 characters.',

            'National_ID_Father.required' => 'The National ID of the father is required.',
            'National_ID_Father.string' => 'The National ID of the father must be a string.',
            'National_ID_Father.max' => 'The National ID of the father cannot exceed 20 characters.',
            'National_ID_Father.unique' => 'The National ID of the father is already taken.',
            'National_ID_Father.regex' => 'The National ID of the father must contain only digits.',

            'Passport_ID_Father.nullable' => 'Passport ID of the father is optional.',
            'Passport_ID_Father.string' => 'The Passport ID of the father must be a string.',
            'Passport_ID_Father.max' => 'The Passport ID of the father cannot exceed 20 characters.',
            'Passport_ID_Father.unique' => 'The Passport ID of the father is already taken.',
            'Passport_ID_Father.regex' => 'The Passport ID of the father can contain only letters and numbers.',

            'Phone_Father.required' => 'The phone number of the father is required.',
            'Phone_Father.string' => 'The phone number of the father must be a string.',
            'Phone_Father.max' => 'The phone number of the father cannot exceed 15 characters.',
            'Phone_Father.regex' => 'The phone number of the father must be a valid phone number.',

            'Nationality_Father_id.required' => 'The nationality of the father is required.',
            'Nationality_Father_id.exists' => 'The selected nationality for the father is invalid.',

            'Religion_Father_id.required' => 'The religion of the father is required.',
            'Religion_Father_id.exists' => 'The selected religion for the father is invalid.',

            'Address_Father.required' => 'The address of the father is required.',
            'Address_Father.string' => 'The address of the father must be a string.',
            'Address_Father.max' => 'The address of the father cannot exceed 255 characters.',

            'National_ID_Mother.required' => 'The National ID of the mother is required.',
            'National_ID_Mother.string' => 'The National ID of the mother must be a string.',
            'National_ID_Mother.max' => 'The National ID of the mother cannot exceed 20 characters.',
            'National_ID_Mother.unique' => 'The National ID of the mother is already taken.',
            'National_ID_Mother.regex' => 'The National ID of the mother must contain only digits.',

            'Passport_ID_Mother.nullable' => 'Passport ID of the mother is optional.',
            'Passport_ID_Mother.string' => 'The Passport ID of the mother must be a string.',
            'Passport_ID_Mother.max' => 'The Passport ID of the mother cannot exceed 20 characters.',
            'Passport_ID_Mother.unique' => 'The Passport ID of the mother is already taken.',
            'Passport_ID_Mother.regex' => 'The Passport ID of the mother can contain only letters and numbers.',

            'Phone_Mother.required' => 'The phone number of the mother is required.',
            'Phone_Mother.string' => 'The phone number of the mother must be a string.',
            'Phone_Mother.max' => 'The phone number of the mother cannot exceed 15 characters.',
            'Phone_Mother.regex' => 'The phone number of the mother must be a valid phone number.',

            'Nationality_Mother_id.required' => 'The nationality of the mother is required.',
            'Nationality_Mother_id.exists' => 'The selected nationality for the mother is invalid.',

            'Religion_Mother_id.required' => 'The religion of the mother is required.',
            'Religion_Mother_id.exists' => 'The selected religion for the mother is invalid.',

            'Address_Mother.required' => 'The address of the mother is required.',
            'Address_Mother.string' => 'The address of the mother must be a string.',
            'Address_Mother.max' => 'The address of the mother cannot exceed 255 characters.',
        ];
    }

}
