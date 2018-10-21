<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarberRequest extends FormRequest
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
			  'name' => 'required|min:2|max:100',
			  'address' => 'required|max:255',
			  'email' => 'required|regex:/^.+@.+$/i',
			  'phone' => 'required|regex:/^[0-9]{3}(-)?[0-9]{3}(-)?[0-9]{4}$/',
        ];
    }
}
