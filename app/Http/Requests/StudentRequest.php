<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StudentRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            return [
                'fullname' => 'required|string',
                'id_status'   => 'required|string',
                'id_gender'   => 'required|string',
                'phone'    => 'required',
                'address'  => 'required|string',
                'email'    => 'required|string|lowercase|email',
            ];
        } else {
            return [
                'fullname' => ['required', 'string', 'unique:'.User::class],
                'id_gender' => ['required', 'string'],
                'id_status' => ['required', 'string'],
                'phone' => ['required'],
                'address' => ['required', 'date'],
                'photo' => ['required', 'image'],
                'email' => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class],
                'password' => ['required', 'confirmed']
            ];
        }
    }
}
