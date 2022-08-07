<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
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
            'code'=>[
                'required',
                'string',
                'size:3',
            ],
            'rate' => 'required|min:0.01|numeric',
        ];
        
        if (!empty($this->currency)) {
            $rules['code'][] = Rule::unique('currencies')->ignore($this->currency->id);
        } else {
            $rules['code'][] = Rule::unique('currencies');
        }
        
        return $rules;
    }
}
