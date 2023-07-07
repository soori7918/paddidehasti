<?php

namespace App\Http\Requests\Padideh\Admin;

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
            'category_id' => 'required|integer|exists:pet_categories,id',
            'city_id' => 'required|integer|exists:base_cities,id',
            'status_id' => 'required|integer|exists:pet_post_statuses,id',
            'user_id' => 'required|integer|exists:users,id',
            'price' => 'required|string',
            'area' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required|string',
        ];
    }

}
