<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Banner;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'link' => $this->link,
            'image' => $this->image ? Banner::SHOW_URL. $this->image : '',
            'image_cover' => $this->image_cover ? Banner::SHOW_URL. $this->image_cover : '',
        ];
    }
}
