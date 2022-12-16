<?php

namespace App\Http\Requests\Customer\Income;

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
            'income_category_id'=>'required|exists:income_categories,id',
            'income'=>'required',
            'description'=>'nullable',
            'date'=>'required',
        ];
    }
}
