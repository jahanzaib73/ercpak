<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\map;

class TripResource extends JsonResource
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
            'vehicle_number' => $this->vehicle_number,
            'image_url' => $this->image_url,
            'model' => $this->model->name,
            'trip' => [
                'id' => $this->activeTrip[0]->id,
                'origin' => $this->activeTrip[0]->origin,
                'destination' => $this->activeTrip[0]->destination,
                'created_at' => $this->activeTrip[0]->created_at,
                'exit_datetime_out' => $this->activeTrip[0]->exit_datetime_out,
            ],
            'driver' => [
                'first_name' => $this->activeTrip[0]->driver->first_name,
                'last_name' => $this->activeTrip[0]->driver->last_name,
                'email' => $this->activeTrip[0]->driver->email,
                'profile_pic_url' => $this->activeTrip[0]->driver->profile_pic_url,
            ],
            'designation' => $this->activeTrip[0]->driver->designation->name,
        ];
    }
}
