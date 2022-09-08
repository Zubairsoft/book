<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => ['required','min:5'],
            'email'=> ['required','email','unique:users,email'],
            'password'=>['required','confirmed']
        ];
    }

    public function message(){
        return [
            'name.required'=>__('required'),
            'email.required'=>__('validation.email.required'),
            'email.unique'=>__('validation.email.unique'),
            'email.email'=>__('validation.email.email'),
            'password.required'=>__(__('passwords.validation.required')),
            'password.confirmed'=>__(__('passwords.validation.confirm'))

        ];
    }
}
