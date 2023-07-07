<?php

namespace App\Http\Requests\Padideh\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'mobile' => 'required|numeric|regex:/^09\d{9}$/',
            'email' => 'nullable',
            'access_status' => 'nullable',
        ];
    }
}
