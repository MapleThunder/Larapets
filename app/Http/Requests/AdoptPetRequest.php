<?php

namespace App\Http\Requests;

use App\Enums\PetColourEnum;
use App\Enums\PetSpeciesEnum;
use App\Models\Pet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AdoptPetRequest extends FormRequest
{
    /**
     * Maximum number of pets a user can have
     */
    const MAX_PETS_PER_USER = 3;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization will be handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:1',
                'max:50',
                function ($attribute, $value, $fail) {
                    if (!Pet::isNameUnique($value)) {
                        $fail('This pet name is already taken.');
                    }
                },
            ],
            'species' => ['required', new Enum(PetSpeciesEnum::class)],
            'colour' => ['required', new Enum(PetColourEnum::class)],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Check if user has reached the pet limit
            $user = $this->user();
            $petCount = Pet::where('user_id', $user->id)->count();
            
            if ($petCount >= self::MAX_PETS_PER_USER) {
                $validator->errors()->add(
                    'user', 'You can only have ' . self::MAX_PETS_PER_USER . ' pets maximum.'
                );
            }
        });
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Pet name is required.',
            'name.min' => 'Pet name must be at least 1 character.',
            'name.max' => 'Pet name must be 50 characters or less.',
            'species.required' => 'Please select a pet species.',
            'species.enum' => 'Please select a valid pet species.',
            'colour.required' => 'Please select a pet colour.',
            'colour.enum' => 'Please select a valid pet colour.',
        ];
    }
}