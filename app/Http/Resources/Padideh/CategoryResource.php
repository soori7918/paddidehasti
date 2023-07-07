<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => Category::IMAGE_BASE_PATH. $this->image,
        ];
    }
}
