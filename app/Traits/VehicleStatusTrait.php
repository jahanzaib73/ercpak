<?php

namespace App\Traits;

use App\Models\Vehicle;

trait VehicleStatusTrait
{
    private $data = [];

    public function getStatus($row){

        $status = '';
        if($row->status == Vehicle::OUTOFSERVICE){
            $status = '<span class="badge badge-danger">Out of Service</span>';
        }else if($row->status == Vehicle::ONMOVE){
            $status = '<span class="badge badge-primary">On Move</span>';
        }else if($row->status == Vehicle::ONWORKSHOP){
            $status = '<span class="badge badge-info">On Workshop</span>';
        }else if($row->status == Vehicle::AVAILABLE){
            $status = '<span class=""badge badge-danger">Available</span>';
        }else if($row->status == Vehicle::UNAVAILABLE){
            $status = '<span class="badge badge-dark">UnAvailable</span>';
        }

        return $status;
    }
    public function getVehicleStatusForTrip($row){

        $status = '';
        if(optional($row->vehicle)->status == Vehicle::OUTOFSERVICE){
            $status = '<span class="badge badge-danger">Out of Service</span>';
        }else if(optional($row->vehicle)->status == Vehicle::ONMOVE){
            $status = '<span class="badge badge-primary">On Move</span>';
        }else if(optional($row->vehicle)->status == Vehicle::ONWORKSHOP){
            $status = '<span class="badge badge-info">On Workshop</span>';
        }else if(optional($row->vehicle)->status == Vehicle::AVAILABLE){
            $status = '<span class=""badge badge-danger">Available</span>';
        }else if(optional($row->vehicle)->status == Vehicle::UNAVAILABLE){
            $status = '<span class="badge badge-dark">UnAvailable</span>';
        }

        return $status;
    }
}
