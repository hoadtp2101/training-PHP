<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemFormRequest extends FormRequest
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
        $formRules = [            
            'name' => [
                "required",
                Rule::unique('items')->ignore($this->id),
            ],      
            'cate_id' => [
                "required"
            ],        
            'user_id' => [
                "required"
            ],        
        ];        
        return $formRules;
    }
}
