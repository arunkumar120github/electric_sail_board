<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SailboatPhotoResource extends JsonResource
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
            'sailboat_id' => $this->sailboat_id,
            'image_url' => $this->image_url,
            'title' => $this->title,
            'description' => $this->description,
            'sailboat' => new SailboatResource($this->whenLoaded('sailboat')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
