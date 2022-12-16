<?php

namespace App\Http\Requests\Admin\User;

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
            'club_id'=>'required|exists:clubs,id',
            'first_name'=>'required', 'string', 'max:255',
            'phone_no'=>'required',
            'last_name' => 'required', 'string', 'max:255',
            'city' => 'required', 'string', 'max:255',
            'email' => 'nullable',
//            'email' => 'nullable|unique:users,email,'.$users->id.',id,deleted_at,NULL',
//            'password' => 'required', 'string', 'min:8', 'confirmed',
        ];
    }
}
