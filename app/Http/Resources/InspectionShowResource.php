<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InspectionShowResource extends JsonResource
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
            'inspection_type' => $this->inspection_type,
            'property_id' => $this->property_id,
            'vehicle_id' => $this->vehicle_id,
            'cost_center_id' => $this->cost_center_id,
            'approved_by_id' => $this->approved_by_id,
            'vendor_id' => $this->vendor_id,
            'meter_reading' => $this->meter_reading,
            'date' => $this->date,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'admin_approve_remarks' => $this->admin_approve_remarks,
            'created_at' => $this->created_at,
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
            'inspectionBies' => $this->inspectionBies->map(function ($inspectionBy) {
                return [
                    'id' => $inspectionBy->id ?? 'N/A',
                    'user_id' => $inspectionBy->user_id ?? 'N/A',
                    'inspection_id' => $inspectionBy->inspection_id ?? 'N/A',
                    'created_at' => $inspectionBy->created_at ?? 'N/A',
                    'user' => [
                        'id' => $inspectionBy->user->id ?? 'N/A',
                        'first_name' => $inspectionBy->user->first_name ?? 'N/A',
                        'last_name' => $inspectionBy->user->last_name ?? 'N/A',
                        'email' => $inspectionBy->user->email ?? 'N/A',
                        'profile_pic_url' => $inspectionBy->user->profile_pic_url ?? 'N/A',
                        'designation' => [
                            'id' => $inspectionBy->user->designation->id ?? 'N/A',
                            'name' => $inspectionBy->user->designation->name ?? 'N/A',
                        ],
                    ],
                ];
            }),
            'inspectionChecklistItems' => $this->inspectionChecklistItems->map(function ($item) {
                return [
                    'id' => $item->id ?? 'N/A',
                    'inspection_checklist_id' => $item->inspection_checklist_id ?? 'N/A',
                    'inspection_id' => $item->inspection_id ?? 'N/A',
                    'status' => $item->status ?? 'N/A',
                    'remarks' => $item->remarks ?? 'N/A',
                    'created_at' => $item->created_at ?? 'N/A',
                    'inspectionItem' => [
                        'id' => $item->inspectionItem->id ?? 'N/A',
                        'name' => $item->inspectionItem->name ?? 'N/A',
                        'status' => $item->inspectionItem->status ?? 'N/A',
                        'user_id' => $item->inspectionItem->user_id ?? 'N/A',
                        'created_at' => $item->inspectionItem->created_at ?? 'N/A',
                    ],
                ];
            }),
            'attachments' => $this->attachments->map(function ($attachment) {
                return [
                    'id' => $attachment->id ?? 'N/A',
                    'file_name' => $attachment->file_name ?? 'N/A',
                    'file_url' => $attachment->file_url ?? 'N/A',
                    'file_type' => $attachment->file_type ?? 'N/A',
                    'inspection_id' => $attachment->inspection_id ?? 'N/A',
                    'user_id' => $attachment->user_id ?? 'N/A',
                    'created_at' => $attachment->created_at ?? 'N/A',
                ];
            }),
        ];
    }
}
