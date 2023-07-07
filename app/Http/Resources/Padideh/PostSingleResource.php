<?php

namespace App\Http\Resources\Padideh;

use App\Models\Petyar\Category;
use App\Models\Petyar\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostSingleResource extends JsonResource
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
            'category' => new CategoryResource($this->category),
            'status' => new PostStatusResource($this->status),
            'images' => PostImageResource::collection($this->images),
            'user' => new PostUserResource($this->user),
            'city' => $this->city->name ?? null,
            'area' => $this->area,
            'phone' => $this->phone,
            'lat' => $this->lat,
            'long' => $this->long,
            'price' => $this->price,
            'description' => $this->description,
            'updated_at' => $this->updated_at,
        ];
    }
}
