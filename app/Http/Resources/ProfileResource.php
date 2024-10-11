<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'wages_type_value' => $this->wages_type_value,
            'email' => $this->email,
            'contact_number' => $this->contact_number,
            'profile_pic_url' => $this->profile_pic_url,
            'created_at' => $this->created_at,
            'designation' => [
                'id' => $this->designation->id ?? 'N/A',
                'name' => $this->designation->name ?? 'N/A',
            ],
        ];
    }
}
