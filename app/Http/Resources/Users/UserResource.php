<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'country' => $this->country,
            'country_key' => $this->country_key,
            'gender' => $this->gender,
            'birthDate' => $this->birthDate,
            'online' => $this->online,
            'last_login_at' => $this->last_login_at,
            'bio' => $this->bio,
            'image_path' => $this->image_path,
            'user_langauges' => $this->user_langauges,

        ];
    }
}
