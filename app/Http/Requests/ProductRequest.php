<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required','max:100','min:10',/*'exists:products,name'*/],
            'description' => ['required','max:100','min:10',/*'exists:products,name'*/],
            'image' => ['image','mimes:jpeg,png'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'El máximo es de 100',
            'name.min' => 'El mínimo es de 10',
        ];
    }
}
