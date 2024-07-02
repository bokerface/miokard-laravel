<?php

namespace App\Http\Requests;

use App\Http\Enums\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'gender' => ['sometimes', Rule::enum(GenderEnum::class)],
            'origin_address' => ['sometimes', 'string', 'max:255'],
            'residence_address' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:25'],
            'emergency_phone' => ['sometimes', 'string', 'max:25'],
            'str_id' => ['sometimes', 'string', 'max:50'],
            'student_id' => ['sometimes', 'string', 'max:50'],
            'entry_year' => ['sometimes', 'numeric', 'max_digits:2'],
            // 'status',
            'bpjs_id' => ['sometimes', 'string', 'max:50'],
            'bank_account' => ['sometimes', 'string', 'max:50'],
            'date_of_birth' => ['sometimes', 'date'],
        ];
    }
}
