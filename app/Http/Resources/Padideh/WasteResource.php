<?php

namespace App\Http\Resources\Padideh;

use App\Models\Padideh\Category;
use App\Models\Padideh\Waste;
use Illuminate\Http\Resources\Json\JsonResource;

class WasteResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->icon ? Waste::SHOW_URL. $this->icon : '',
        ];
    }
}
