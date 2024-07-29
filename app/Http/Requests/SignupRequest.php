<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username'=>'required|max:30',
            'phone_number'=>'required|max:30',
            'profile_photo'=>'required|mimes:jpg,bmp,png',
            'certificate'=>'required|mimes:pdf',
            'email'=>'required|email',
            'password'=>'required|min:8|max:20',
            'password_confirmation'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username'=>'This Filed is required',
            'phone_number'=>'This Filed is required',
            'profile_photo'=>'This Filed is required|Image type is not supported',
            'certificate '=>'This Filed is required',
            'email'=>'This Filed is required',
            'password'=>'This Filed is required',
            'password_confirmation'=>'This Filed is required'
        ];
    }
}
