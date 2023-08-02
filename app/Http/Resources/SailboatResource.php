<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SailboatResource extends JsonResource
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
            'year' => $this->year,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'displacement' => $this->displacement,
            'status' => $this->status,
            'loa' => $this->loa,
            'motor' => $this->motor,
            'battery_brand' => $this->battery_brand,
            'battery_type' => $this->battery_type,
            'solar_panel' => $this->solar_panel,
            'wind_generator' => $this->wind_generator,
            'genset' => $this->genset,
            'controller' => $this->controller,
            'sailing_type' => $this->sailing_type,
            'description' => $this->description,
            'likes' => count($this->likes),
            'favourites' => count($this->favourites),
            'comments' => SailboatCommentResource::collection($this->comments),
            'faqs' => SailboatFaqResource::collection($this->faqs),
            'photos' => SailboatPhotoResource::collection($this->photos),
            'videos' => SailboatVideoResource::collection($this->videos),
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
