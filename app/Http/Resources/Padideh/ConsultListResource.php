<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Category;
use App\Models\Padideh\Consultation;
use App\Models\Padideh\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultListResource extends JsonResource
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
            'owner' => Consultation::CONSULTER,
            'room_id' => $this->room_id,
            'status' => $this->status,
            'status_text' => $this->getStatusText(),
            'updated_at' => $this->updated_at,
        ];
    }
}
