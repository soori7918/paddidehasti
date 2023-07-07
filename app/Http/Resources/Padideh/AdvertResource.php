<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Advert;
use App\Models\Padideh\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'image' => Advert::IMAGE_BASE_PATH. $this->image,
        ];
    }
}
