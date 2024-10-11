<?php

namespace App\Imports;

use App\Models\GuestVistor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Models\City; // Ensure all models are imported
use App\Models\Country;
use App\Models\PurposeOfVisit;
use App\Models\Department;
use App\Models\Desigination;

class GuestVisitorsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Initialize variables
        $city = null;
        $purposeOfVisit = null;
        $department = null;
        $country = null;
        $designation = null;
        $sub_department = null;

        // Find city by name using like query
        if (!empty($row['city'])) {
            $city = City::where('name', 'like', '%' . $row['city'] . '%')->first();
            if (!$city) {
                throw new \Exception('City not found: ' . $row['city']);
            }
        }

        // Find country by name using like query
        if (!empty($row['country'])) {
            $country = Country::where('name', 'like', '%' . $row['country'] . '%')->first(); // Assuming 'Country' is the correct model
            if (!$country) {
                throw new \Exception('Country not found: ' . $row['country']);
            }
        }

        // Find purpose of visit by name using like query
        if (!empty($row['purpose_of_visit'])) {
            $purposeOfVisit = PurposeOfVisit::where('name', 'like', '%' . $row['purpose_of_visit'] . '%')->first();
            if (!$purposeOfVisit) {
                throw new \Exception('Purpose of Visit not found: ' . $row['purpose_of_visit']);
            }
        }

        // Find department by name using like query
        if (!empty($row['department'])) {
            $department = Department::where('name', 'like', '%' . $row['department'] . '%')->first();
            if (!$department) {
                throw new \Exception('Department not found: ' . $row['department']);
            }
        }

        // Find sub department by name using like query
        if (!empty($row['sub_department'])) {
            $sub_department = Department::where('name', 'like', '%' . $row['sub_department'] . '%')->first();
            if (!$sub_department) {
                throw new \Exception('Sub Department not found: ' . $row['sub_department']);
            }
        }

        // Find designation by name using like query
        if (!empty($row['designation'])) {
            $designation = Desigination::where('name', 'like', '%' . $row['designation'] . '%')->first(); // Corrected the model name from 'Desigination' to 'Designation'
            if (!$designation) {
                throw new \Exception('Designation not found: ' . $row['designation']);
            }
        }


        // Handle Image Upload (assuming image file path is available in $row['image'])
        $imageName = null;
        $imageUrl = null;

        if (isset($row['image']) && $row['image'] != null) {
            // Generate unique image name
            $imageName = time() . '_' . uniqid() . '.' . $row['image']->getClientOriginalExtension();

            // Store image in 'public/images' folder
            $imagePath = $row['image']->storeAs('public/images', $imageName);

            // Get the URL for the stored image
            $imageUrl = Storage::url($imagePath);
        }
        return new GuestVistor([
            'vistor_name'          => $row['name'],
            'cnic'                 => (string) $row['cnic'],
            'passport_number'      => $row['passport'],
            'purpose_of_visit_id'  => $purposeOfVisit ? $purposeOfVisit->id : null,  // Matched purpose_of_visit or null if not found
            'special_field'        => $row['tribe'],
            'department_id'        => $department ? $department->id : null,  // Matched department or null if not found
            'address'              => $row['address'],
            'city_id'              => $city ? $city->id : null,  // Matched city or null if not found
            'province_id'          => $row['province'],
            'vistor_contact'       => $row['contacts'],
            'vistor_email'         => $row['emails'], // Corrected key from 'cmails' to 'emails'
            'date_time'            => Carbon::parse($row['date'])->format('Y-m-d'), // Formats as date (YYYY-MM-DD)
            'dob'                  => Carbon::parse($row['dob'])->format('Y-m-d'), // Formats as date (YYYY-MM-DD)
            'image_name'           => $imageName, // Store the image file name
            'image_url'            => $imageUrl,  // Store the image URL

            'company'              => $row['company'],
            'designation_id'          => $designation ? $designation->id : null,
            'sub_department_id'    => $sub_department ? $sub_department->id : null,
            'whatsapp'             => $row['whatsapp'],
            'no_visa'              => $row['no_visa'], // Assuming 'no_visa' is a boolean field
            'country_id'           => $country ? $country->id : null,
        ]);
    }
}
