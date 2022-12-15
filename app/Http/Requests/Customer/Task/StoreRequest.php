<?php

namespace App\Http\Requests\Customer\Task;

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
            'task_category_id'=>'required|exists:task_categories,id',
            'name'=>'required',
            'type'=>'required|boolean',
            'task_date'=>'required_if:type,0',
            'start_date'=>'required_if:type,1',
            'end_date'=>'required_if:type,1',
            'frequency'=>'required_if:type,1',
            'day_of_week'=>'required_if:frequency,2',
            'day_of_week_1'=>'required_if:frequency,1',
            'day_of_week_2'=>'required_if:frequency,1',
            'day_of_month'=>'required_if:frequency,3',

        ];
    }
}
