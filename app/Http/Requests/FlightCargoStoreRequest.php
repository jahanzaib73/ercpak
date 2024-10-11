<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FlightCargoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'flight_number' => ['required_if:flight_cargo_type_id,1'],
            'flight_type_id' => ['required_if:flight_cargo_type_id,1'],
            'aircraft_vessel_id' => ['required_if:flight_cargo_type_id,1'],
            'flight_belongs_to' => ['required_if:flight_cargo_type_id,1'],
            // 'flight_notes' => ['required_if:flight_cargo_type_id,1'],

            'arrival_flight_origin' => ['required_if:flight_cargo_type_id,1'],
            'arrival_flight_date_time' => ['required_if:flight_cargo_type_id,1'],
            'arrival_flight_destination' => ['required_if:flight_cargo_type_id,1'],
            'arrival_flight_destination_date_time' => ['required_if:flight_cargo_type_id,1'],

            'arrival_number_of_passengers' => ['required_if:arrival_is_flight_passengers,on'],
            'arrival_vehicle_attachment' => ['required_if:arrival_is_flight_passengers,on'],
            'arrival_weight_of_flight_cargo' => ['required_if:arrival_is_flight_cargo,on'],
            'arrival_flight_cargo_attachment' => ['required_if:arrival_is_flight_cargo,on'],
            'arrival_number_of_faicons' => ['required_if:arrival_is_flight_faicons,on'],
            'arrival_faicon_attachment' => ['required_if:arrival_is_flight_faicons,on'],
            'arrival_number_of_flight_vehicle' => ['required_if:arrival_is_flight_vehicles,on'],
            'arrival_flight_vehicle_attachment' => ['required_if:arrival_is_flight_vehicles,on'],

            'sea_vessel_number' => ['required_if:flight_cargo_type_id,2'],
            'sea_vessel_type' => ['required_if:flight_cargo_type_id,2'],
            'sea_arrival_origin' => ['required_if:flight_cargo_type_id,2'],
            'sea_arrival_date_time' => ['required_if:flight_cargo_type_id,2'],
            'sea_destination' => ['required_if:flight_cargo_type_id,2'],
            'sea_destination_date_time' => ['required_if:flight_cargo_type_id,2'],
            'cargo_belongs_to' => ['required_if:flight_cargo_type_id,2'],
            // 'cargo_notes' => ['required_if:flight_cargo_type_id,2'],
            // 'sea_notes' => ['required_if:flight_cargo_type_id,2'],
            // 'is_sea_cargo_vehicles' => ['required_if:flight_cargo_type_id,2'],
            'number_of_vehicle' => ['required_if:is_sea_cargo_vehicles,on'],
            'sea_vehicle_attachment' => ['required_if:is_sea_cargo_vehicles,on'],
            // 'is_sea_cargo' => ['required_if:flight_cargo_type_id,2'],
            'weight_of_cargo' => ['required_if:is_sea_cargo,on'],
            'sea_cargo_attachment' => ['required_if:is_sea_cargo,on'],
            // 'is_sea_cargo_other' => ['required_if:flight_cargo_type_id,2'],
            'sea_cargo_other_details' => ['required_if:is_sea_cargo_other,on'],
            'sea_cargo_other_attachment' => ['required_if:is_sea_cargo_other,on'],

            'road_arrival_origin' => ['required_if:flight_cargo_type_id,3'],
            'road_arrival_date_time' => ['required_if:flight_cargo_type_id,3'],
            'road_destination' => ['required_if:flight_cargo_type_id,3'],
            'road_destination_date_time' => ['required_if:flight_cargo_type_id,3'],
            'road_cargo_belongs_to' => ['required_if:flight_cargo_type_id,3'],
            // 'road_notes' => ['required_if:flight_cargo_type_id,3'],
            'road_type_of_cargo' => ['required_if:flight_cargo_type_id,3'],
            'road_cargo_list_attachments' => [
                Rule::requiredIf(function() {
                    return !empty($this->request->get('road_list_of_cargo'));
                })
            ],
            // 'road_driver_name' => ['required_if:flight_cargo_type_id,3'],
            // 'road_driver_number' => ['required_if:flight_cargo_type_id,3'],
            // 'road_vehicle_number_type' => ['required_if:flight_cargo_type_id,3'],
        ];
    }

    public function messages(){
        return [
            'flight_number.required_if' => 'Flight Number field is required.',
            'flight_type_id.required_if' => 'Flight Type field is required.',
            'aircraft_vessel_id.required_if' => 'Aircraft field is required.',
            'flight_belongs_to.required_if' => 'Belongs To field is required.',
            // 'flight_notes.required_if' => 'Notes field is required.',

            'arrival_flight_origin.required_if' => 'Origin field is required.',
            'arrival_flight_date_time.required_if' => 'Date Time field is required.',
            'arrival_flight_destination.required_if' => 'Destination field is required.',
            'arrival_flight_destination_date_time.required_if' => 'Date Time field is required.',

            'arrival_number_of_passengers.required_if' => 'Number Of Passengers field is required.',
            'arrival_vehicle_attachment.required_if' => 'Attachments Of Passengers field is required.',
            'arrival_weight_of_flight_cargo.required_if' => 'Wheight of Cargo field is required.',
            'arrival_flight_cargo_attachment.required_if' => 'Attachments of Cargo field is required.',
            'arrival_number_of_faicons.required_if' => 'Falcon field is required.',
            'arrival_faicon_attachment.required_if' => 'Falcon Attachments field is required.',
            'arrival_number_of_flight_vehicle.required_if' => 'Number Of Vehicles field is required.',
            'arrival_flight_vehicle_attachment.required_if' => 'Vehicles Attachments field is required.',



            'sea_vessel_number.required_if' => 'Vessel Number field is required.',
            'sea_vessel_type.required_if' => 'Vessel Type field is required.',
            'sea_arrival_origin.required_if' => 'Origin field is required.',
            'sea_arrival_date_time.required_if' => 'Date Time field is required.',
            'sea_destination.required_if' => 'Destination field is required.',
            'sea_destination_date_time.required_if' => 'Date Time field is required.',
            'cargo_belongs_to.required_if' => 'Belongs To field is required.',
            // 'cargo_notes.required_if' => 'Notes field is required.',
            'number_of_vehicle.required_if' => 'Number Of Vehicles field is required.',
            'sea_vehicle_attachment.required_if' => 'Attachments Of Vehicles field is required.',
            'weight_of_cargo.required_if' => 'Wheight of Cargo field is required.',
            'sea_cargo_attachment.required_if' => 'Attachments of Cargo field is required.',
            'sea_cargo_other_details.required_if' => 'Other Details field is required.',
            'sea_cargo_other_attachment.required_if' => 'Attachments field is required.',
            'sea_notes.required_if' => 'Notes field is required.',
            'road_arrival_origin.required_if' => 'Origin field is required.',
            'road_arrival_date_time.required_if' => 'Date Time field is required.',
            'road_destination.required_if' => 'Destination field is required.',
            'road_destination_date_time.required_if' => 'Date Time field is required.',
            'road_cargo_belongs_to.required_if' => 'Belongs To field is required.',
            // 'road_notes.required_if' => 'Notes field is required.',
            'road_type_of_cargo.required_if' => 'Type Of Cargo field is required.',
            // 'road_list_of_cargo.required_if' => 'List Of Cargo field is required.',
            // 'road_driver_name.required_if' => 'Driver Name field is required.',
            // 'road_driver_number.required_if' => 'Driver Number field is required.',
            // 'road_vehicle_number_type.required_if' => 'Vehicle Type/Number field is required.',
            // 'is_sea_cargo_vehicles.required_if' => 'Vehicle field is required.',
            // 'is_sea_cargo.required_if' => 'Cargo field is required.',
            // 'is_sea_cargo_other.required_if' => 'Other field is required.',
        ];
    }
}
