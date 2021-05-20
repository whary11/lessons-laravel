<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

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
        $now = Carbon::now()->toDateTimeString();
        return [
            'total' => ['required'],
            'tax' => ['required'],
            'shipping_value' => ['required'],
            'delivery_date' => 'date_format:Y-m-d|after_or_equal:'.$now.'|required',
        ];
    }
}
