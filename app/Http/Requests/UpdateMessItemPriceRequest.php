<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessItemPriceRequest extends FormRequest
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
    public function rules()
    {
        return [
            'scale'=>['required'],
            'price'=>'required | gt:1',
            'status'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'price.gt' => 'Enter a valid amount',
        ];
    }
}
