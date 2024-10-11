<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestVisitorAttachment;
use App\Models\GuestVistor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class GuestVisitorAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($guestVisitId)
    {
        $this->authorize('All Guest & Visitor Attachment');
        $data['guestVisitorAttachments'] = GuestVisitorAttachment::where('guest_visitor_id', $guestVisitId)->orderBy('id', 'desc')->get();
        $data['guestVisitId'] = $guestVisitId;
        return view('new-admin.guest_vistors.guest_visitor_attachments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Guest & Visitor Attachment');
        $data['guestVisitId'] = $id;
        return view('new-admin.guest_vistors.guest_visitor_attachments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->authorize('Add Guest & Visitor Attachment');
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'expiary_date' => ['required', 'date'],
            'attachment' => ['required', 'mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf'],
        ], [
            'attachment.required' => 'The File is required',
            'attachment.string' => 'The File should be a string',
            'attachment.in' => 'The File should be Letters Received OR Issued by Consulte',
        ]);

        $attachment = $request->attachment;
        $extension = $attachment->getClientOriginalExtension();
        $fileName = rand(1, 100000) . time() . '.' . $extension;
        $attachment->move(public_path('guest_visitor_attachments'), $fileName);
        $url = asset('/guest_visitor_attachments/' . $fileName);

        $guestVisitorAttachment = GuestVisitorAttachment::create([
            'file_name' => $request->name,
            'notes' => $request->notes,
            'expiary_date' => $request->expiary_date,
            'file_extension' => $extension,
            'file_url' => $url,
            'user_id' => Auth::id(),
            'guest_visitor_id' => $request->guestVisitId,
            'status' => $request->status,
        ]);


        // Check if SMS checkbox is checked and send SMS using Twilio
        if ($request->has('send_sms')) {
            $smsResult = $this->sendSmsNotification($request->status, $request->guestVisitId);
        }
        return redirect()->route('guest-visitor-attachment.index', ['id' => $request->guestVisitId])->with('success', 'Data added Successfully');
    }
    protected function sendSmsNotification($status, $guestVisitId)
    {
        // Your new SMS service API credentials
        $api_key = env('SMS_API_KEY'); // Fetching the API key from environment variables
        $sender = "8584"; // Ensure this is the correct Sender ID as per your SMS provider
        $template_id = 9991; // Template ID you want to use

        // Fetch the guest visit details from the database
        $guestVisit = GuestVistor::find($guestVisitId);

        // JSON-encoded message to be sent (e.g., {"status": "Pending"})
        $message = json_encode(['status' => $status]);

        // Recipient phone numbers (use actual visitor contact from the database if needed)
        $phoneNumbers = [
            '923010005497', // Replace with dynamic phone number if needed
            '923212545222', // Replace with dynamic phone number if needed
            '923009679311',
            $guestVisit->vistor_contact  // Replace with dynamic phone number if needed
        ];

        // Base API URL
        $baseUrl = "https://sendpk.com/api/sms.php";

        // Iterate over the phone numbers and send SMS
        foreach ($phoneNumbers as $toPhoneNumber) {
            // Build the full API URL with query parameters
            $url = $baseUrl . "?api_key=" . urlencode($api_key) . "&sender=" . urlencode($sender) . "&mobile=" . urlencode($toPhoneNumber) . "&template_id=" . urlencode($template_id) . "&message=" . urlencode($message);

            // Create a stream context for the HTTP GET request
            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n", // JSON header
                    'method'  => 'GET', // The API seems to expect GET parameters in the URL
                    'timeout' => 30,    // Timeout in seconds
                ]
            ];

            $context  = stream_context_create($options);

            // Send the request and capture the response
            $result = file_get_contents($url, false, $context);

            // Handle error if request fails
            if ($result === FALSE) {
                // Log or handle the error, you could continue with the next number
                return "Error: Failed to send SMS to $toPhoneNumber";
            }

            // Optionally log or process each response if needed
        }

        // Return success or log the responses if all messages were sent
        return "SMS sent to all recipients successfully.";
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->authorize('Edit Guest & Visitor Attachment');
        $data['attachment'] = GuestVisitorAttachment::findOrFail($id);
        return view('new-admin.guest_vistors.guest_visitor_attachments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('Edit Guest & Visitor Attachment');
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'expiary_date' => ['required', 'date'],

        ]);

        $attachmentData = GuestVisitorAttachment::findOrFail($id);
        if ($request->has('attachment')) {
            $attachment = $request->attachment;
            $extension = $attachment->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $attachment->move(public_path('guest_visitor_attachments'), $fileName);
            $url = asset('/guest_visitor_attachments/' . $fileName);

            $attachmentData->update([
                'file_name' => $request->name,
                'notes' => $request->notes,
                'file_extension' => $extension,
                'file_url' => $url,
                'status' => $request->status,
            ]);
        } else {
            $attachmentData->update([
                'notes' => $request->notes,
                'file_name' => $request->name,
                'status' => $request->status,
            ]);
        }
        // Check if SMS checkbox is checked and send SMS using Twilio
        if ($request->has('send_sms')) {
            $this->sendSmsNotification($request->status, $attachmentData->guest_visitor_id);
        }

        return redirect()->route('guest-visitor-attachment.index', ['id' => $request->guestVisitId])->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Guest & Visitor Attachment');
        $attachment = GuestVisitorAttachment::where('id', $id)->first();
        $guestVisitorId = $attachment->guest_visitor_id;
        $attachment->delete();
        return redirect()->route('guest-visitor-attachment.index', ['id' => $guestVisitorId])->with('success', 'Data Deleted Successfully');
    }
}
