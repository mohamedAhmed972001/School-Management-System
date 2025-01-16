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
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'Gender_id' => 'required|exists:genders,id',
            'Nationality_id' => 'required|exists:nationalities,id',
            'Date_Birth' => 'required|date|before:today',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'Section_id' => 'required|exists:sections,id',
            'Parent_id' => 'required|exists:myparents,id',  // تأكد من اسم الجدول هنا
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
            'name.ar.required' => 'اسم الطالب باللغة العربية مطلوب.',
            'name.en.required' => 'اسم الطالب باللغة الإنجليزية مطلوب.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقًا.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب أن تكون كلمة المرور مكونة من 8 أحرف على الأقل.',
            'Gender_id.required' => 'معرف الجنس مطلوب.',
            'Gender_id.exists' => 'الجنس المحدد غير صحيح.',
            'Nationality_id.required' => 'معرف الجنسية مطلوب.',
            'Nationality_id.exists' => 'الجنسية المحددة غير صحيحة.',
            'Date_Birth.required' => 'تاريخ الميلاد مطلوب.',
            'Date_Birth.before' => 'يجب أن يكون تاريخ الميلاد قبل اليوم.',
            'Grade_id.required' => 'معرف الدرجة مطلوب.',
            'Grade_id.exists' => 'الدرجة المحددة غير صحيحة.',
            'Classroom_id.required' => 'معرف الصف مطلوب.',
            'Classroom_id.exists' => 'الصف المحدد غير صحيح.',
            'Section_id.required' => 'معرف القسم مطلوب.',
            'Section_id.exists' => 'القسم المحدد غير صحيح.',
            'Parent_id.required' => 'معرف الوالدين مطلوب.',
            'Parent_id.exists' => 'الوالد المحدد غير صحيح.',
            'Academic_Year.required' => 'السنة الدراسية مطلوبة.',
        ];
    }
}
