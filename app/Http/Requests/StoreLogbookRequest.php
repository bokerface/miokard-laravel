<?php

namespace App\Http\Requests;

use App\Http\Enums\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLogbookRequest extends FormRequest
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
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:255'],
            'date' => ['date'],
            'patient_name' => ['string', 'required', 'max:255'],
            'patient_gender' => [Rule::enum(GenderEnum::class)],
            'patient_age' => ['numeric', 'required', 'max_digits:3'],
            'type_of_action' => ['string', 'required', 'max:255'],
        ];
    }
}
