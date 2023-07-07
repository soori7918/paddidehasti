<?php

namespace App\Http\Requests\Padideh\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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
            'name' => 'nullable|string|max:30',
            'family' => 'nullable|string|max:50',
            'mobile' => 'required|numeric|regex:/^09\d{9}$/',
            'car_id' => 'nullable|numeric|max:100',
            'car_pelak' => 'nullable|string|max:100',
            'car_name' => 'nullable|string|max:100',
            'shaba_number' => 'nullable|numeric',
            'card_number' => 'nullable|numeric',
            'image' => 'nullable',
            'is_active' => 'nullable',
        ];
    }
}
