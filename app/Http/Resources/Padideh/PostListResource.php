<?php

namespace App\Http\Resources\Padideh;

use App\Models\Petyar\Category;
use App\Models\Petyar\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostListResource extends JsonResource
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
            'image' => new PostImageResource($this->images()->first()),
            'city' => $this->city->name ?? null,
            'area' => $this->area,
            'price' => $this->price,
            'updated_at' => $this->updated_at,
        ];
    }
}
