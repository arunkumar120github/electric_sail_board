<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SailboatCommentResource extends JsonResource
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
            'replies' => SailboatCommentResource::collection($this->whenLoaded('replies')),
            'comment' => $this->comment,
            'likes' => count($this->likes),
            'reports' => count($this->reports),
            'user' => new UserResource($this->user),
            'sailboat' => new SailboatResource($this->whenLoaded('sailboat')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
