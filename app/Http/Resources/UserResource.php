<?php

namespace App\Http\Resources;

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
            'id' => $this->id ?? 'N/A',
            'first_name' => $this->first_name ?? 'N/A',
            'last_name' => $this->last_name ?? 'N/A',
            'email' => $this->email ?? 'N/A',
            'profile_pic_url' => $this->profile_pic_url ?? 'N/A',
        ];
    }
}
