<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFormRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
  public function store()
  {
    return [
    'book_name'=>'required',
    'description'=>'required',

    ];
  }

  public function update()
  {
    return [
        'book_name'=>'required',
        'description'=>'required',

        ];
  }
}
