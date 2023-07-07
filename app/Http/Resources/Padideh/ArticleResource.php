<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'short_description' => $this->short_description,
            'full_description' => $this->full_description,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'image' => $this->image ? Article::SHOW_URL. $this->image : '',
        ];
    }
}
