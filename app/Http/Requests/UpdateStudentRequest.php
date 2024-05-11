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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            // 'photo',
            'gender' => ['required', Rule::enum(GenderEnum::class)],
            'origin_address' => ['required', 'string', 'max:255'],
            'residence_address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
            'emergency_phone' => ['required', 'string', 'max:25'],
            'student_id' => ['required', 'string', 'max:50'],
            // 'status',
            'bpjs_id' => ['required', 'string', 'max:50'],
            'bank_account' => ['required', 'string', 'max:50'],
            'age' => ['required', 'numeric', 'max_digits:3'],
        ];
    }
}
