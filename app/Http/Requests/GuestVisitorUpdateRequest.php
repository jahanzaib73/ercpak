<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestVisitorUpdateRequest extends FormRequest
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
            'cnic' => ['required','max:20'],
            // 'purpose_of_visit_id' => ['required','numeric'],
            // 'passport_number' => ['required','string'],
            'vistor_name' => ['required_if:type,VISTORS','string',],
            'vistor_email' => ['required_if:type,VISTORS','email'],
            'vistor_contact' => ['required_if:type,VISTORS','string'],
            'province_id' => ['required_if:type,VISTORS','numeric'],
            'city_id' => ['required_if:type,VISTORS','numeric'],
            'address' => ['required_if:type,VISTORS','string'],
            'guest_id' => ['required_if:type,GUEST'],
            // 'department_id' => ['required','numeric'],
            // 'location_id' => ['required','numeric'],
            // 'host_id' => ['required','numeric'],
            // 'lat' => ['required'],
            // 'lng' => ['required'],
            // 'time_in' => ['required'],
            // 'time_out' => ['required'],
            // 'currency' => ['required','in:USD,AED,PKR'],
            // 'fee' => ['required','numeric'],
        ];
    }
}
