<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SailboatFaqResource extends JsonResource
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
            'question' => $this->question,
            'answer' => $this->answer,
            'sailboat' => new SailboatResource($this->whenLoaded('sailboat')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
