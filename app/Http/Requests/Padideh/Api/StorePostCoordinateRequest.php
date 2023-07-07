<?php

namespace App\Http\Requests\Padideh\Api;

use App\Models\Padideh\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostCoordinateRequest extends FormRequest
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
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ];
    }
}
