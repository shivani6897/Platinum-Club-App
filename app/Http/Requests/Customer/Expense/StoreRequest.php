<?php

namespace App\Http\Requests\Customer\Expense;

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
            'expense_category_id'=>'required|exists:expense_categories,id',
            'expense'=>'required',
            'description'=>'nullable',
            'date'=>'required',
        ];
    }
}
