<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $inspection = $this->inspection;
        $approvedByUser = null;

        // Fetch the user details based on the approved_by_id
        if ($inspection->approved_by_id) {
            $approvedByUser = User::with('designation')->find($inspection->approved_by_id);
        }

        return [
            'id' => $this->id,
            'technicians_notes' => $this->technicians_notes,
            'inspection_id' => $this->inspection_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'inspection' => [
                'id' => $this->inspection->id,
                'inspection_type' => $this->inspection->inspection_type,
                'property_id' => $this->inspection->property_id,
                'vehicle_id' => $this->inspection->vehicle_id,
                'cost_center_id' => $this->inspection->cost_center_id,
                'approved_by_id' => $this->inspection->approved_by_id,
                'vendor_id' => $this->inspection->vendor_id,
                'meter_reading' => $this->inspection->meter_reading,
                'date' => $this->inspection->date,
                'status' => $this->inspection->status,
                'remarks' => $this->inspection->remarks,
                'admin_approve_remarks' => $this->inspection->admin_approve_remarks,
                'created_at' => $this->inspection->created_at,
                'approved_by' => $approvedByUser ? [
                    'id' => $approvedByUser->id ?? 'N/A',
                    'first_name' => $approvedByUser->first_name ?? 'N/A',
                    'last_name' => $approvedByUser->last_name ?? 'N/A',
                    'profile_pic_url' => $approvedByUser->profile_pic_url ?? 'N/A',
                    'designation' => $approvedByUser->designation ? [
                        'id' => $approvedByUser->designation->id ?? 'N/A',
                        'name' => $approvedByUser->designation->name ?? 'N/A',
                    ] : null,
                ] : null,
                'costCenter' => [
                    'id' => $this->inspection->costCenter->id ?? 'N/A',
                    'title' => $this->inspection->costCenter->title ?? 'N/A',
                ],
                'vehicle' => [
                    'id' => $this->inspection->vehicle->id ?? 'N/A',
                    'vehicle_number' => $this->inspection->vehicle->vehicle_number ?? 'N/A',
                    'engine_number' => $this->inspection->vehicle->engine_number ?? 'N/A',
                    'chassis_number' => $this->inspection->vehicle->chassis_number ?? 'N/A',
                    'color' => $this->inspection->vehicle->color ?? 'N/A',
                    'year' => $this->inspection->vehicle->year ?? 'N/A',
                    'base_meter_reading' => $this->inspection->vehicle->base_meter_reading ?? 'N/A',
                    'current_meter_reading' => $this->inspection->vehicle->current_meter_reading ?? 'N/A',
                    'last_meter_reading' => $this->inspection->vehicle->last_meter_reading ?? 'N/A',
                    'image_url' => $this->inspection->vehicle->image_url ?? 'N/A',
                    'notes' => $this->inspection->vehicle->notes ?? 'N/A',
                    'is_outsource' => $this->inspection->vehicle->is_outsource ?? 'N/A',
                    'status' => $this->inspection->vehicle->status ?? 'N/A',
                    'created_at' => $this->inspection->vehicle->created_at ?? 'N/A',
                    'model' => [
                        'id' => $this->inspection->vehicle->model->id ?? 'N/A',
                        'name' => $this->inspection->vehicle->model->name ?? 'N/A',
                    ],
                ],
                'assignedTechnicians' => $this->inspection->assignedTehnicians->map(function ($technician) {
                    return [
                        'id' => $technician->id ?? 'N/A',
                        'user_id' => $technician->user_id ?? 'N/A',
                        'inspection_id' => $technician->inspection_id ?? 'N/A',
                        'created_at' => $technician->created_at ?? 'N/A',
                        'user' => [
                            'id' => $technician->user->id ?? 'N/A',
                            'first_name' => $technician->user->first_name ?? 'N/A',
                            'last_name' => $technician->user->last_name ?? 'N/A',
                            'email' => $technician->user->email ?? 'N/A',
                            'profile_pic_url' => $technician->user->profile_pic_url ?? 'N/A',
                            'designation' => [
                                'id' => $technician->user->designation->id ?? 'N/A',
                                'name' => $technician->user->designation->name ?? 'N/A',
                            ],
                        ],
                    ];
                }),
                'inspectionChecklistItems' => $this->inspection->inspectionChecklistItems->map(function ($item) {
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
                'attachments' => $this->inspection->attachments->map(function ($attachment) {
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
            ]
        ];
    }
}
