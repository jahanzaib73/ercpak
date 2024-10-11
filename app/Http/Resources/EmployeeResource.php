<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'contact_number' => $this->contact_number,
            'whats_app_number' => $this->whats_app_number,
            'wages_type' => $this->wages_type,
            'wages_type_value' => $this->wages_type_value,
            'employee_type' => $this->employee_type,
            'employee_sub_type' => $this->employee_sub_type,
            'address' => $this->address,
            'notes' => $this->notes,
            'email' => $this->email,
            'profile_pic_name' => $this->profile_pic_name,
            'profile_pic_url' => $this->profile_pic_url,
            'is_activity_assignment' => $this->is_activity_assignment,
            'created_at' => $this->created_at,
            'leaves' => $this->leaves,
            'dob' => $this->dob,
            'designation' => [
                'id' => $this->designation->id ?? 'N/A',
                'name' => $this->designation->name ?? 'N/A',
            ],
        ];
    }
}
