<?php

namespace App\Http\Requests\Customer\Product;

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
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|min:1',
            'downpayment'=>'required|numeric|min:0',
            'tax'=>'required|numeric|min:0',
            'emi'=>'nullable',
            'image'=>'nullable|mimes:jpg,jpeg,png',
            'description'=>'nullable',
            'is_free_trial'=>'nullable|boolean',
            'trial_duration_type'=>'required_if:is_free_trial,1',
            'trial_duration'=>'required_if:is_free_trial,1',
            'trial_price'=>'required_if:is_free_trial,1',
            'is_subscription'=>'nullable|boolean',
            'billing_period'=>'required_if:is_subscription,1',
        ];
    }

    public function messages()
    {
        return [
            'trial_duration_type.required_if' => 'The trial duration type field is required when is free trial is checked.',
            'trial_duration.required_if' => 'The trial duration field is required when is free trial is checked.',
            'trial_price.required_if' => 'The trial price field is required when is free trial is checked.',
            'billing_period.required_if' => 'The billing period field is required when is subscription is checked.'
        ];
    }
}
