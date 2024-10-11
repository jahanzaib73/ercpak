<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'vehicle_number' => $this->vehicle_number ?? 'N/A',
            'engine_number' => $this->engine_number ?? 'N/A',
            'chassis_number' => $this->chassis_number ?? 'N/A',
            'color' => $this->color ?? 'N/A',
            'year' => $this->year ?? 'N/A',
            'base_meter_reading' => $this->base_meter_reading ?? 'N/A',
            'current_meter_reading' => $this->current_meter_reading ?? 'N/A',
            'last_meter_reading' => $this->last_meter_reading ?? 'N/A',
            'image_url' => $this->image_url ?? 'N/A',
            'notes' => $this->notes ?? 'N/A',
            'is_outsource' => $this->is_outsource ?? 'N/A',
            'status' => $this->status ?? 'N/A',
            'created_at' => $this->created_at ?? 'N/A',
            'model' => [
                'id' => $this->model->id ?? 'N/A',
                'name' => $this->model->name ?? 'N/A',
            ],
            'make' => [
                'id' => $this->make->id ?? 'N/A',
                'name' => $this->make->name ?? 'N/A',
            ],
            'type' => [
                'id' => $this->type->id ?? 'N/A',
                'name' => $this->type->name ?? 'N/A',
            ],
        ];
    }
}
