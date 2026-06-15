<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $email  = $this->method() != 'PUT' ? Rule::unique('users' , 'email') :
                    Rule::unique('users' , 'email')->ignore($this->user()->id);
        $required = $this->method() != 'PUT' ? 'required|confirmed' : 'nullable';

        return [
            'name'      => 'required|string|',
            'email'         => 'required|email',
            'role'          => 'required|exists:roles,id',
            'password'      => 'min:4|string|'.$required
        ];
    }
}
