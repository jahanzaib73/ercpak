<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name' => ['required','string','min:3','max:255'],
            'last_name' => ['required','string','min:3','max:255'],
            'email' => ['required','email','unique:users,email','string'],
            'password' => ['required','min:8','max:255'],
            'designation_id' => ['required','numeric'],
            'department_id' => ['required','numeric'],
            'location_id' => ['required','numeric'],
            'city_id' => ['required','numeric'],
            'province_id' => ['required','numeric'],
            'country_id' => ['required','numeric'],
            'contact_number' => ['required','min:11','max:11'],
            'employee_type' =>['required','in:Regular,Temporary,Contract'],
            'employee_sub_type' =>['required','in:Diplomates,Foreigners,Locals']
        ];
    }

    public function messages(){
        return [
            'designation_id.required' => 'Designation field is requried',
            'designation_id.numeric' => 'Designation should be a numeric value',
            'department_id.required' => 'Department field is requried',
            'department_id.numeric' => 'Department should be a numeric value',
            'location_id.required' => 'Location field is requried',
            'location_id.numeric' => 'Location should be a numeric value',
            'city_id.required' => 'City field is requried',
            'city_id.numeric' => 'City should be a numeric value',
            'province_id.required' => 'Province field is requried',
            'province_id.numeric' => 'Province should be a numeric value',
            'country_id.required' => 'Country field is requried',
            'country_id.numeric' => 'Country should be a numeric value',
        ];
    }
}
