<?php

namespace App\Http\Requests\Customer\OfflinePayment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'customer_id'=>'required|exists:customers,id',
            'product_name'=>'array|min:1',
            'product_qty'=>'array|min:1',
            'product_price'=>'array|min:1',
            'description'=>'nullable',
//            'payment_method'=>'numeric|between:0,2',
//            'name_on_card'=>'required_unless:payment_method,0',
//            'card_number'=>'required_unless:payment_method,0',
//            'expiry_date'=>'required_unless:payment_method,0',
//            'security_code'=>'required_unless:payment_method,0',
        ];
    }
}
