<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapAreaResource extends JsonResource
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
            'area_name' => $this->area_name,
            'polygon_coordinates' => $this->polygon_coordinates,
            'created_at' => $this->created_at,
            'singleAssignArea' => [
                'id' => $this->getSignleAssignArea->id ?? 'N/A',
                'session_year' => $this->getSignleAssignArea->session_year ?? 'N/A',
                'created_at' => $this->getSignleAssignArea->created_at ?? 'N/A',
                'team' => [
                    'id' => $this->getSignleAssignArea->team->id ?? 'N/A',
                    'team_name' => $this->getSignleAssignArea->team->team_name ?? 'N/A',
                    'team_name_urdu' => $this->getSignleAssignArea->team->team_name_urdu ?? 'N/A',
                    'team_color' => $this->getSignleAssignArea->team->team_color ?? 'N/A',
                    'team_symbol' => $this->getSignleAssignArea->team->team_symbol ?? 'N/A',
                    'team_symbol_url' => $this->getSignleAssignArea->team->team_symbol_url ?? 'N/A',
                    'created_at' => $this->getSignleAssignArea->team->created_at ?? 'N/A',
                ],
                'member' => [
                    'id' => $this->getSignleAssignArea->member->id ?? 'N/A',
                    'member_name' => $this->getSignleAssignArea->member->member_name ?? 'N/A',
                    'photo_url' => $this->getSignleAssignArea->member->photo_url ?? 'N/A',
                    'created_at' => $this->getSignleAssignArea->member->created_at ?? 'N/A',
                ]
            ],
        ];
    }
}
