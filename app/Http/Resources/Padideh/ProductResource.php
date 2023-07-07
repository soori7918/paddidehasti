<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'link' => $this->link,
            'description' => $this->description,
            'image' => $this->image ? Product::SHOW_URL. $this->image : '',
        ];
    }
}
