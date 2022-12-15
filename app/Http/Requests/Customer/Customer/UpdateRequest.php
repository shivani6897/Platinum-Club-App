<?php

namespace App\Http\Requests\Customer\Customer;

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
            'customer_name' => 'required|max:255',
            'company_name' => 'required','string',
            'email' => 'nullable',
            'phone_no' => 'required','numeric',
            'gst_no' => 'nullable','numeric',
            'state' => 'required','string',
            'company_address' => 'nullable','string','max:255',
        ];
    }
}
