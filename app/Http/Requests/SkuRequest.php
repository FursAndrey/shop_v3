<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
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
            'product_id'=>'required|integer|exists:products,id',
            'currency_id'=>'required|integer|exists:currencies,id',
            'price' => 'required|min:0.01|numeric',
            'count' => 'required|min:0|integer',
        ];
    }
}
