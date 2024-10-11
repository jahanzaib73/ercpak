<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaManagementResource extends JsonResource
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
            'member_name' => $this->member_name,
            'photo_url' => $this->photo_url,
            'created_at' => $this->created_at,
            'cities_by_province' => $this->cities_by_province,
            'team' => [
                'id' => $this->team->id ?? 'N/A',
                'team_name' => $this->team->team_name ?? 'N/A',
                'team_name_urdu' => $this->team->team_name_urdu ?? 'N/A',
                'team_color' => $this->team->team_color ?? 'N/A',
                'team_symbol' => $this->team->team_symbol ?? 'N/A',
                'team_symbol_url' => $this->team->team_symbol_url ?? 'N/A',
                'created_at' => $this->team->created_at ?? 'N/A',
            ],
            'user' => [
                'id' => $this->user->id ?? 'N/A',
                'first_name' => $this->user->first_name ?? 'N/A',
                'last_name' => $this->user->last_name ?? 'N/A',
                'profile_pic_url' => $this->user->profile_pic_url ?? 'N/A',
                'designation' => [
                    'id' => $this->user->designation->id,
                    'name' => $this->user->designation->name,
                ]
            ],
        ];
    }
}
