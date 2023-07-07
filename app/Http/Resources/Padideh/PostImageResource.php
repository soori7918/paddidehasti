<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Category;
use App\Models\Padideh\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostImageResource extends JsonResource
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
            'image' => Post::IMAGE_BASE_PATH. $this->image_location,
        ];
    }
}
