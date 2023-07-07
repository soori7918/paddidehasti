<?php

namespace App\Http\Requests\Padideh\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'category' => 'required|integer|exists:pet_categories,id',
            'city' => 'required|integer|exists:base_cities,id',
            'price' => 'required|string',
            'area' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required|string',
        ];
    }

}
