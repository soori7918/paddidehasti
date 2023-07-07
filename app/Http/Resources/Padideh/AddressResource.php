<?php

namespace App\Http\Resources\Padideh;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address' => $this->address,
            'user_name' => $this->user_name,
            'user_mobile' => $this->user_mobile,
            'lat' => $this->lat,
            'long' => $this->long,
        ];
    }
}
