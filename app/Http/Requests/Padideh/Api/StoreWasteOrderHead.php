<?php

namespace App\Http\Requests\Padideh\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreWasteOrderHead extends FormRequest
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
            'address_id' => 'required|numeric|exists:user_addresses,id,user_id,'.auth('api')->user()->id,
            'delivery_date' => 'required|string',
            'orders' => 'required|array',
            'orders.*.waste_id' => 'required|exists:wastes,id',
            'orders.*.weight' => 'required|numeric|min:0',
        ];
    }
}
