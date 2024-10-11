<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            'terms' => $this->terms,
            'ship_via' => $this->ship_via,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'user' => [
                'id' => $this->user->id ?? 'N/A',
                'name' => $this->user->name ?? 'N/A',
            ],
            'vendor' => [
                'id' => $this->vendor->id ?? 'N/A',
                'name' => $this->vendor->name ?? 'N/A',
            ],
            'location' => [
                'id' => $this->location->id ?? 'N/A',
                'name' => $this->location->name ?? 'N/A',
            ],
            'warehouse' => [
                'id' => $this->warehouse->id ?? 'N/A',
                'name' => $this->warehouse->name ?? 'N/A',
            ],
            'requestBy' => [
                'id' => $this->requestBy->id ?? 'N/A',
                'first_name' => $this->requestBy->first_name ?? 'N/A',
                'last_name' => $this->requestBy->last_name ?? 'N/A',
            ],
        ];
    }
}
