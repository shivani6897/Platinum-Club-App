<?php

namespace App\Http\Requests\Customer\Customer;

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
            'name' => 'required|max:255',
            'company_name' => 'nullable','string',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'phone_no' => 'required','numeric',
            'gst_no' => 'nullable','numeric',
            'state' => 'required','string',
            'company_address' => 'nullable','string','max:255',
        ];
    }
}
