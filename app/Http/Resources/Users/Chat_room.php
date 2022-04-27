<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class Chat_room extends JsonResource
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
            'unread_count' => $this->unread_count,
            'friend' => $this->friend,
            'last_message' => $this->last_message,
            'all_messages' => $this->all_messages,


        ];
    }
}
