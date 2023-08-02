<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'gender' => $this->gender,
            'age' => $this->age,
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
            'sailing_experience' => $this->sailing_experience,
            'preferred_type' => json_decode($this->preferred_type),
            'preferred_type_string' => $this->preferred_type_string,
            'household_income' => $this->household_income,
            'is_sailboat_owner' => $this->is_sailboat_owner,
            'vendor_id' => $this->vendor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
