<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            "name" => "required|string",
            "phone_num" => "nullable|digits_between:0,14",
            "paid" => "required|numeric|min:0|gte:total_payment",
            "address" => "nullable|string",
            "payment_method" => "required"
        ];
    }
}
