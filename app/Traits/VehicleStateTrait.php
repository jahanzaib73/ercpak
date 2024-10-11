<?php

namespace App\Traits;

use App\Models\Vehicle;

trait VehicleStateTrait
{
    private $data = [];
    public function getStates(){

        $this->data['allVehicle'] = Vehicle::allVehicles();
        $this->data['onMove'] = Vehicle::onMove();
        $this->data['onWorkshop'] = Vehicle::onWorkshop();
        $this->data['outOfService'] = Vehicle::outOfService();

        return $this->data;
    }
}
