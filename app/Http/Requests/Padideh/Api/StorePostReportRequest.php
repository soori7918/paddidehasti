<?php

namespace App\Http\Requests\Padideh\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePostReportRequest extends FormRequest
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
            'reason' => 'required|integer|exists:pet_report_reasons,id',
            'post' => 'required|integer|exists:pet_posts,id',
            'description' => 'required|string',
        ];
    }
}
