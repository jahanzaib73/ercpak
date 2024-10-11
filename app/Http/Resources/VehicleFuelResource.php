<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleFuelResource extends JsonResource
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
            'date' => $this->date,
            'qty' => $this->qty,
            'created_at' => $this->created_at,
            'fuelType' => [
                'id' => $this->fuelType->id ?? 'N/A',
                'name' => $this->fuelType->name ?? 'N/A',
            ],
        ];
    }
}
