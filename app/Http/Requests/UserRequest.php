<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules =  [
            'nama' => 'required|min:3',
            'level' => 'required|in:bendahara,user'
        ];
        if ($this->getMethod() == 'POST') {
            $rules +=  [
                'username' => 'required|unique:users',
                'password' => 'required|min:6',
            ];
        }

        if ($this->getMethod() == 'PUT') {
            $rules +=  ['username' => "required|unique:users,username,{$this->user}"];
        }

        return $rules;
    }
}
