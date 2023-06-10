<?php

namespace App\Http\Requests;

use App\Models\MessMenuDetails;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreMessMenuRequest extends FormRequest
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
//            'menu_type'=>'required|in:breakfast,lunch,dinner,event,other',
//            'menu_type'=> ['required'],
            'meal_type'=> ['required'],
            'menu_name'=>['required'],
            'menu_items'=> 'required|array|min:1',
            'status'=>['required'],
        ];
    }
}
//'url' => 'unique:site1,your_column_name|unique:site2:your_column_name_2'