<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreMessMenuItemRequest extends FormRequest
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
            'category_id'=>['required'],
            'status'=>['required'],
            'item_name'=>[
                'required',
                Rule::unique('mess_menu_items')
                    ->where('mess_id', Auth::user()->mess_id)
            ],
        ];

        // $request->validate(['name' => 'required|unique:items,name,establishment_id']);
        // 'item_name'=>'required | unique:mess_menu_items,item_name,mess_id',

    }
}
