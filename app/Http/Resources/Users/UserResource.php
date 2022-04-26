<?php

namespace App\Http\Resources\Users;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "name" => $this->name,
            "country" => $this->country,
            "gender" => $this->gender,
            "birthDate" => $this->birthDate,
            "online" => $this->online,
            "last_login_at" => $this->last_login_at,
            "bio" => $this->bio,
            "age" => $this->age,
            "image_path" => $this->image_path,
            "langauges" => $this->langauges,
            "chat_room_id" => $this->chat_room_id,
            
        ];
    }
}
