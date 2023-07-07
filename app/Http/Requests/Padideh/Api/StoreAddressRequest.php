<?php

namespace App\Http\Requests\Padideh\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'title' => 'required|string',
            'address' => 'required|string',
            'user_name' => 'required|string',
            'user_mobile' => 'required|string',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ];
    }

}
