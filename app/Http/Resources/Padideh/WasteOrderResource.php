<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Waste;
use Illuminate\Http\Resources\Json\JsonResource;

class WasteOrderResource extends JsonResource
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
            'waste_icon' => $this->waste ? Waste::SHOW_URL.$this->waste->icon : null,
            'name' => $this->name,
            'unit' => $this->unit,
            'weight' => $this->weight,
            'price' => $this->price,
        ];
    }
}
