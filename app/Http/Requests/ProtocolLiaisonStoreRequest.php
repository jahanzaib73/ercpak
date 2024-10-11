<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProtocolLiaisonStoreRequest extends FormRequest
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
            'official_name' => ['required_if:protocol_liaisontype_id,1'],
            'official_designation' => ['required_if:protocol_liaisontype_id,1'],
            'official_city_id' => ['required_if:protocol_liaisontype_id,1'],
            'official_email' => ['required_if:protocol_liaisontype_id,1'],
            'official_google_map_lat' => ['nullable', 'string'],
            'official_google_map_lng' => ['nullable', 'string'],
            'official_address' => ['required_if:protocol_liaisontype_id,1'],
            'official_biography' => ['required_if:protocol_liaisontype_id,1'],


            'notable_name' => ['required_if:protocol_liaisontype_id,2'],
            'notable_city_id' => ['required_if:protocol_liaisontype_id,2'],
            'notable_email' => ['required_if:protocol_liaisontype_id,2'],
            'notable_google_map_lat' => ['nullable', 'string'],
            'notable_google_map_lng' => ['nullable', 'string'],
            'notable_biography' => ['required_if:protocol_liaisontype_id,2'],
            'notable_address' => ['required_if:protocol_liaisontype_id,2'],

            'company_name' => ['required_if:protocol_liaisontype_id,3'],
            'company_city' => ['required_if:protocol_liaisontype_id,3'],
            'company_email' => ['required_if:protocol_liaisontype_id,3'],
            'company_google_map_lat' => ['nullable', 'string'],
            'company_google_map_lng' => ['nullable', 'string'],
            'company_website' => ['required_if:protocol_liaisontype_id,3'],
            'company_about' => ['required_if:protocol_liaisontype_id,3'],
            'company_address' => ['required_if:protocol_liaisontype_id,3'],

            'project_name' => ['required_if:protocol_liaisontype_id,4'],
            // 'city_id' => ['required_if:protocol_liaisontype_id,4'],
            'location_id' => ['required_if:protocol_liaisontype_id,4'],
            'project_email' => ['required_if:protocol_liaisontype_id,4'],
            'project_google_map_lat' => ['nullable', 'string'],
            'project_google_map_lng' => ['nullable', 'string'],
            'project_website' => ['required_if:protocol_liaisontype_id,4'],
            'project_company_about' => ['required_if:protocol_liaisontype_id,4'],
            'project_address' => ['required_if:protocol_liaisontype_id,4'],
            'project_description' => ['required_if:protocol_liaisontype_id,4'],

            'property_name' => ['required_if:protocol_liaisontype_id,5'],
            'property_city' => ['required_if:protocol_liaisontype_id,5'],
            'property_google_map_lat' => ['nullable', 'string'],
            'property_google_map_lng' => ['nullable', 'string'],
            'property_company_about' => ['required_if:protocol_liaisontype_id,5'],
            'property_address' => ['required_if:protocol_liaisontype_id,5'],
            'property_description' => ['required_if:protocol_liaisontype_id,5'],

        ];
    }


    public function messages()
    {
        return [
            'official_name.required_if' => 'Official Name is required.',
            'official_designation.required_if' => 'Official Designation is required.',
            'department_id.required_if' => 'Department is required.',
            'official_email.required_if' => 'Official Email is required.',
            'official_google_map_lat.required_if' => 'Latitude is required.',
            'official_google_map_lng.required_if' => 'Longitude is required.',
            'official_biography.required_if' => 'Official Biography is required.',

            'notable_name.required_if' => 'Notable Name is required.',
            'notable_city_id.required_if' => 'Notable City/Town is required.',
            'notable_email.required_if' => 'Notable Email is required.',
            'notable_google_map_lat.required_if' => 'Latitude  is required.',
            'notable_google_map_lng.required_if' => 'Longitude  is required.',
            'notable_biography.required_if' => 'Notable Biography is required.',
            'notable_address.required_if' => 'Notable Address is required.',

            'company_name.required_if' => 'Company Name is required.',
            'company_city.required_if' => 'Company City/Town is required.',
            'company_email.required_if' => 'Company Email is required.',
            'company_google_map_lat.required_if' => 'Latitude is required.',
            'company_google_map_lng.required_if' => 'Longitude  is required.',
            'company_website.required_if' => 'Company Website URL is required.',
            'company_about.required_if' => 'Company Aboute is required.',
            'company_address.required_if' => 'Company Address is required.',

            'project_name.required_if' => 'Project Name is requried.',
            'city_id.required_if' => 'Project City/Town is requried.',
            'location_id.required_if' => 'Project City/Town is requried.',
            'project_email.required_if' => 'Project Email is requried.',
            'project_google_map_lat.required_if' => 'Latitude is requried.',
            'project_google_map_lng.required_if' => 'Longitude is requried.',
            'project_website.required_if' => 'Project Website URL is requried.',
            'project_company_about.required_if' => 'Project Company About is requried.',
            'project_address.required_if' => 'Project Address is requried.',
            'project_description.required_if' => 'Project Description is requried.',

            'property_name.required_if' => 'Property Name is requried.',
            'property_city.required_if' => 'Property City/Town is requried.',
            'property_google_map_lat.required_if' => 'Latitude is requried.',
            'property_google_map_lng.required_if' => 'Longitude is requried.',
            'property_company_about.required_if' => 'Property Company About is requried.',
            'property_address.required_if' => 'Property Address is requried.',
            'property_description.required_if' => 'Property Description is requried.',
        ];
    }
}
