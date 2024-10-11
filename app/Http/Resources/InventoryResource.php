<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'item_number' => $this->item_number,
            'item_code' => $this->item_code,
            'item_name' => $this->item_name,
            'description' => $this->description,
            'room_number' => $this->room_number,
            'inventroy_type' => $this->inventroy_type,
            'image_name' => $this->image_name,
            'image_url' => $this->image_url,
            'barcode' => $this->barcode,
            'upc' => $this->upc,
            'unit_cost' => $this->unit_cost,
            'qty' => $this->qty,
            'bin' => $this->bin,
            'is_expiry_available' => $this->is_expiry_available,
            'expiry_date' => $this->expiry_date,
            'is_warranty_available' => $this->is_warranty_available,
            'warranty_date' => $this->warranty_date,
            'warranty_notes' => $this->warranty_notes,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'type' => [
                'id' => $this->type->id ?? 'N/A',
                'name' => $this->type->name ?? 'N/A',
            ],
            'make' => [
                'id' => $this->make->id ?? 'N/A',
                'name' => $this->make->name ?? 'N/A',
            ],
            'category' => [
                'id' => $this->category->id ?? 'N/A',
                'name' => $this->category->name ?? 'N/A',
            ],
            'unitType' => [
                'id' => $this->unitType->id ?? 'N/A',
                'name' => $this->unitType->name ?? 'N/A',
            ],
            'warehouse' => [
                'id' => $this->warehouse->id ?? 'N/A',
                'name' => $this->warehouse->name ?? 'N/A',
            ],
            'location' => [
                'id' => $this->location->id ?? 'N/A',
                'name' => $this->location->name ?? 'N/A',
            ],
            'user' => [
                'id' => $this->user->id ?? 'N/A',
                'first_name' => $this->user->first_name ?? 'N/A',
                'last_name' => $this->user->last_name ?? 'N/A',
                'email' => $this->user->email ?? 'N/A',
                'profile_pic_url' => $this->user->profile_pic_url ?? 'N/A',
            ],
        ];
    }
}
