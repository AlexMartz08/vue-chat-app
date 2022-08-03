<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResouce extends JsonResource
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
            'text' => $this->text,
//            'sender_id' => $this->sender_id,
//            'receiver' => $this->receiver,
            'sender' => UserResource::make($this->whenLoaded('sender')),
            'receiver' => UserResource::make($this->whenLoaded('receiver')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
