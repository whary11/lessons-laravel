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
            'tax' => ['required','integer','min:1'],
            'shipping_value' => ['required'],
            'delivery_date' => 'date_format:Y-m-d H:i:s|after_or_equal:'.$now.'|required',
            'user_id' => ['required','integer','exists:users,id'],
            'status_id' => ['required','integer','exists:statuses,id'],
            'details' => ['required','array','min:1'],
            'details.*.price' => ['required','integer','min:1'],
            'details.*.price_with_discount' => ['required','integer','min:1'],
            'details.*.product_id' => ['required','integer','exists:products,id'],
            'details.*.quantity' => ['required','integer','min:1'],
            'details.*.tax' => ['required','integer','min:1'],
        ];
    }
}
