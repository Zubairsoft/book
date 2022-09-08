<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class LocalFormRequest extends FormRequest
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

            'lang'=>['required','rule'=>Rule::in(User::LOCAL)]
        ];
    }

    public function messages()
    {
        return [
            'lang.required' => __('validation.lang.required'),
            'lang.rule' => __('validation.lang.rule'),
        ];
    }
}
