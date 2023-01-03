<?php

namespace App\Http\Requests\Customer\OfflinePayment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        ];
    }
}
