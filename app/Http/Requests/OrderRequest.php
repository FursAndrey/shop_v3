<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
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
        $rules = [
            'user_name' => 'required|string|between:3,32',
            'user_email' => ['email'],
            'description_ru' => 'nullable|string|between:10,200',
        ];
        if (Auth::check()) {
            $this->request->set('user_email', Auth::user()->email);
        } else {
            $rules['user_email'][] = 'required';
        }
        return $rules;
    }
}
