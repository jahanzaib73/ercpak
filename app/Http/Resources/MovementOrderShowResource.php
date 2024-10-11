<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovementOrderShowResource extends JsonResource
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
            'exit_meetr_reading' => $this->exit_meetr_reading,
            'exit_datetime_out' => $this->exit_datetime_out,
            'return_meetr_reading' => $this->return_meetr_reading,
            'return_datetime_out' => $this->return_datetime_out,
            'return_notes' => $this->return_notes,
            'notes' => $this->notes,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'is_cancelled' => $this->is_cancelled,
            'cancelled_reason' => $this->cancelled_reason,
            'costCenter' => [
                'id' => $this->costCenter->id ?? 'N/A',
                'title' => $this->costCenter->title ?? 'N/A',
            ],
            'vehicle' => [
                'id' => $this->vehicle->id ?? 'N/A',
                'vehicle_number' => $this->vehicle->vehicle_number ?? 'N/A',
                'engine_number' => $this->vehicle->engine_number ?? 'N/A',
                'chassis_number' => $this->vehicle->chassis_number ?? 'N/A',
                'color' => $this->vehicle->color ?? 'N/A',
                'year' => $this->vehicle->year ?? 'N/A',
                'base_meter_reading' => $this->vehicle->base_meter_reading ?? 'N/A',
                'current_meter_reading' => $this->vehicle->current_meter_reading ?? 'N/A',
                'last_meter_reading' => $this->vehicle->last_meter_reading ?? 'N/A',
                'image_url' => $this->vehicle->image_url ?? 'N/A',
                'notes' => $this->vehicle->notes ?? 'N/A',
                'is_outsource' => $this->vehicle->is_outsource ?? 'N/A',
                'status' => $this->vehicle->status ?? 'N/A',
                'created_at' => $this->vehicle->created_at ?? 'N/A',
                'model' => [
                    'id' => $this->vehicle->model->id ?? 'N/A',
                    'name' => $this->vehicle->model->name ?? 'N/A',
                ],
            ],
            'official' => [
                'id' => $this->official->id ?? 'N/A',
                'first_name' => $this->official->first_name ?? 'N/A',
                'last_name' => $this->official->last_name ?? 'N/A',
                'contact_number' => $this->driver->contact_number ?? 'N/A',
                'whats_app_number' => $this->driver->whats_app_number ?? 'N/A',
                'email' => $this->official->email ?? 'N/A',
                'profile_pic_url' => $this->official->profile_pic_url ?? 'N/A',
                'designation' => [
                    'id' => $this->official->designation->id ?? 'N/A',
                    'name' => $this->official->designation->name ?? 'N/A',
                ],
            ],
            'driver' => [
                'id' => $this->driver->id ?? 'N/A',
                'first_name' => $this->driver->first_name ?? 'N/A',
                'last_name' => $this->driver->last_name ?? 'N/A',
                'contact_number' => $this->driver->contact_number ?? 'N/A',
                'whats_app_number' => $this->driver->whats_app_number ?? 'N/A',
                'email' => $this->driver->email ?? 'N/A',
                'profile_pic_url' => $this->driver->profile_pic_url ?? 'N/A',
                'designation' => [
                    'id' => $this->official->designation->id ?? 'N/A',
                    'name' => $this->official->designation->name ?? 'N/A',
                ],
            ],
        ];
    }
}
