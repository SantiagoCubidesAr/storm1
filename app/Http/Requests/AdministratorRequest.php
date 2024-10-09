<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class AdministratorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'PUT') {
            return [
                'fullname' => 'required|string|unique:users,fullname,'. $this->id,
                'status'   => 'required|string',
                'gender'   => 'required|string',
                'phone'    => 'required',
                'address'  => 'required|date',
                'email'    => 'required|string|lowercase|email|unique:users,email,'.$this->id,

            ];
        } else {
            return [
                'fullname' => ['required', 'string', 'unique:'.User::class],
                'gender' => ['required', 'string'],
                'status' => ['required', 'string'],
                'phone' => ['required'],
                'address' => ['required', 'date'],
                'photo' => ['required', 'image'],
                'email' => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class],
                'password' => ['required', 'confirmed']
            ];
        }
    }
}
