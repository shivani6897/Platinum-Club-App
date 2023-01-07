<?php

namespace App\Http\Requests\Customer\PromoCode;

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
            'code'=>'required',
            'start_date'=>'nullable',
//            'end_date'=>'required',
            'value'=>'nullable',
            'is_flat'=>'nullable',
        ];
    }
}
