<?php

namespace App\Http\Resources\Padideh\V1;

use Verta;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $response = [
            'id' => $this->id,
            'name' => $this->name ,
            'family' => $this->family ,
            'mobile' => $this->mobile ,
            'email' => $this->email ,
            'access_status' => $this->access_status,
            'region' => $this->region ,
            'created_at' => getjalaliDate($this->created_at) ,
        ];

        return $response;
    }
}
