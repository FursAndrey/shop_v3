<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name_ru'=>'required|between:3,32',
            'name_en'=>'required|between:3,32',
            'description_ru' => 'required|string|between:10,200',
            'description_en' => 'required|string|between:10,200',
        ];
    }
}
