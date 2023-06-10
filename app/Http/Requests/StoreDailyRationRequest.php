<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyRationRequest extends FormRequest
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
            'menu'=>'required',
//            'meal_time'=>'required',
            'menu_type'=>'required',
            'price'=>'required|gt:0.99',
            'date'=>'required|date',
            'desert'=>'',
        ];
    }
}
