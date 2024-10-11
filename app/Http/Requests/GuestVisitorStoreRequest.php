<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestVisitorStoreRequest extends FormRequest
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
        //Need to change field name in the form
        return [
            'category' => ['required'],
            'cnic' => ['required','max:20'],
            'passport_number' => ['required','string'],
            'vistor_name' => ['required','string'],
            'specialField' => ['required','string'],
            'address' => ['required', 'string'],
            'city_id' => ['required','numeric'],
            'vistor_contact' => ['required','string'],
            'vistor_email' => ['required','email'],
            'date_time' => ['required'],
            'croppedImage' => ['required'],

            // 'purpose_of_visit_id' => ['required','numeric'],
            // 'province_id' => ['required','numeric'],
            // 'guest_id' => ['required_if:type,GUEST'],
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

    public function messages()
    {
        return [
            'cnic.required' => 'CNIC is required.',
            'cnic.max' => 'The CNIC should not be greater than 20 characters.',
            'passport_number.required' => 'Passport number is required.',
            'passport_number.string' => 'Passport number must be a string.',
            'vistor_name.required' => 'Full name is required.',
            'vistor_name.string' => 'The Full name must be a string.',
            'specialField.required' => 'Special field is required.',
            'specialField.string' => 'The special field must be a string.',
            'address.required' => 'Address is required.',
            'address.string' => 'The address must be a string.',
            'city_id.required' => 'City is required.',
            'city_id.numeric' => 'The city field is invalid.',
            'vistor_contact.required' => 'Contact is required.',
            'vistor_contact.string' => 'The contact must be a string.',
            'vistor_email.required' => 'Email is required.',
            'vistor_email.email' => 'The email must be a valid email address.',
            'date_time.required' => 'Date and time is required.',
            'croppedImage.required' => 'Photo is required.',
        ];
    }
}
