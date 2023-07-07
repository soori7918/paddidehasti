<?php

namespace App\Http\Resources\Padideh;

use App\Models\Petyar\Category;
use App\Models\Petyar\Consultation;
use App\Models\Petyar\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class TurnoverListResource extends JsonResource
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
            'amount' => $this->amount,
            'title' => $this->title,
            'updated_at' => $this->updated_at,
        ];
    }
}
