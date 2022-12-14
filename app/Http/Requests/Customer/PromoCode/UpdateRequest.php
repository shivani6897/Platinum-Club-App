<?php

namespace App\Http\Requests\Customer\PromoCode;

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
            'code'=>'required|max:255',
//            'start_date'=>'required',
//            'end_date'=>'required',
            'value'=>'required',
            'is_flat'=>'nullable',
        ];
    }
}
