<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParentAttachmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // يمكنك تعديلها حسب متطلباتك
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // قبول الصور والمستندات بحجم أقصى 2MB
            'Parent_id' => 'required|exists:MyParents,id',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'file.required' => 'The file is required.',
            'file.file' => 'The uploaded item must be a valid file.',
            'file.mimes' => 'The file must be of type: jpg, jpeg, png, or pdf.',
            'file.max' => 'The file size must not exceed 2MB.',

            'Parent_id.required' => 'The Parent ID is required.',
            'Parent_id.exists' => 'The provided Parent ID does not exist in the database.',
        ];
    }

}
