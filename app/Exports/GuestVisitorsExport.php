<?php

namespace App\Exports;

use App\Models\GuestVistor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
class GuestVisitorsExport implements FromCollection, WithHeadings
{
    protected $guestVisitors;

    // Constructor to accept the guest visitors data (e.g., selected rows)
    public function __construct($guestVisitors)
    {
        $this->guestVisitors = $guestVisitors;
    }

    /**
     * Export the guest visitors data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->guestVisitors->map(function ($guestVisitor) {
            return [
                'ID' => $guestVisitor->id,
                'Name' => $guestVisitor->vistor_name,
                'CNIC' => $guestVisitor->cnic,
                'Passport' => $guestVisitor->passport_number,
                'Purpose of Visit' => $guestVisitor->purposeOfVisit ? $guestVisitor->purposeOfVisit->name : 'N/A',
                'Department' => $guestVisitor->department ? $guestVisitor->department->name : 'N/A',
                'Sub Department' => $guestVisitor->subDepartment ? $guestVisitor->subDepartment->name : 'N/A',
                'City' => $guestVisitor->city ? $guestVisitor->city->name : 'N/A',
                'Province' => $guestVisitor->province ? $guestVisitor->province->name : 'N/A',
                'Country' => $guestVisitor->country ? $guestVisitor->country->name : 'N/A',
                'Contact' => $guestVisitor->vistor_contact,
                'Email' => $guestVisitor->vistor_email,
                'DOB' => $guestVisitor->dob ? Carbon::parse($guestVisitor->dob)->format('Y-m-d') : 'N/A',  // Safely handle dob
                'Image URL' => $guestVisitor->image_url,
                'Designation' => $guestVisitor->designation ? $guestVisitor->designation->name : 'N/A',
                'Company' => $guestVisitor->company,
                'WhatsApp' => $guestVisitor->whatsapp,
                'No Visa' => $guestVisitor->no_visa ? 'Yes' : 'No', // Assuming no_visa is a boolean
            ];
        });
    }

    /**
     * Define the column headers for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'CNIC',
            'Passport',
            'Purpose of Visit',
            'Department',
            'Sub Department',
            'City',
            'Province',
            'Country',
            'Contact',
            'Email',
            'DOB',
            'Image URL',
            'Designation',
            'Company',
            'WhatsApp',
            'No Visa'
        ];
    }
}
