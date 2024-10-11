<?php

namespace App\Jobs;

use App\Mail\MeetingEmail;
use App\Models\Employee;
use App\Models\EmployeeRemainder;
use App\Models\MeetingHostParticipant;
use App\Models\ProtocolLiaison;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class MeetingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $emailData;
    protected $emailAction;
    protected $isRemainder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailData,$emailAction,$isRemainder = false)
    {
        $this->emailData = $emailData;
        $this->emailAction = $emailAction;
        $this->isRemainder = $isRemainder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->isRemainder){
            $employeeIds = EmployeeRemainder::where('remainder_id',$this->emailData->id)->pluck('employee_id');
            $employees = Employee::whereIn('id',$employeeIds)->get();
            $data = [];
            $index = 0;
            foreach($employees as $employee){
                $data[$index]['remainderTitle'] = $this->emailData->title;
                $data[$index]['remainderDetail'] = $this->emailData->detail;
                $data[$index]['remainderExpairyDate'] = $this->emailData->expairy_date;
                $data[$index]['remainderDate'] = Carbon::parse($this->emailData->created_at)->toDateTimeString();
                $data[$index]['remainderRemainderType'] = optional($this->emailData->remainderType)->name;
                $data[$index]['remainderIssuingAuthority'] = optional($this->emailData->issuingAuthority)->name_of_issuing_authorities;
                $data[$index]['employeeName'] = $employee->name;
                $data[$index]['email'] = $employee->email;
                $data[$index]['meeting_action'] = $this->emailAction;
                $data[$index]['isRemainder'] = $this->isRemainder;
            }
            foreach ($data as $emailData) {
                $email = new MeetingEmail($emailData);
                Mail::to($emailData['email'])->send($email);
                sleep(5);
            }
        }else{
            $memberIds = MeetingHostParticipant::where('meeting_id', $this->emailData->id)->pluck("member_id");
            $members = DB::table('protocol_liaisons')->whereIn('id',$memberIds)->get();

            // $hostData = [];
            // $hostIndex = 0;
            // foreach ($this->emailData->hosts as $host) {
            //     $member = DB::table('protocol_liaisons')->where('id',$host->member_id)->first();
            //     if($host->official_notable_type == 'Notable'){
            //         $hostData[$hostIndex]['email'] = $member->notable_email;
            //     }elseif($host->official_notable_type == 'Official'){
            //         $hostData[$hostIndex]['email'] = $member->official_email;
            //     }
            //     $hostData[$hostIndex]['type'] = $host->official_notable_type;
            //     $hostIndex++;
            // }

            // $participantData = [];
            // $participantIndex = 0;
            // foreach ($this->emailData->participants as $participant) {
            //     $member = DB::table('protocol_liaisons')->where('id',$participant->member_id)->first();
            //     if($participant->official_notable_type == 'Notable'){
            //         $participantData[$participantIndex]['email'] = $member->notable_email;
            //     }elseif($participant->official_notable_type == 'Official'){
            //         $participantData[$participantIndex]['email'] = $member->official_email;
            //     }
            //     $participantData[$participantIndex]['type'] = $participant->official_notable_type;
            //     $participantIndex++;
            // }

            $data = [];
            $index = 0;
            foreach ($members as $member) {
                $protocolType = DB::table('protocol_liaison_types')->where('id',$member->protocol_liaisontype_id)->first();
               if($protocolType->name == 'Official'){
                   $data[$index]['email'] = $member->official_email;
                   $data[$index]['name'] = $member->official_name;
               }elseif($protocolType->name == 'Notable'){
                   $data[$index]['email'] = $member->notable_email;
                   $data[$index]['name'] = $member->notable_name;
               }

               $data[$index]['start_date_time'] = $this->emailData->meeting_date_time;
               $data[$index]['end_date_time'] = $this->emailData->meeting_end_date_time;
               $data[$index]['meeting_title'] = $this->emailData->meeting_title;
               $data[$index]['meeting_location'] = $this->emailData->meeting_location;
               $data[$index]['meeting_detail'] = $this->emailData->meeting_detail;
               $data[$index]['meeting_action'] = $this->emailAction;
            //    $data[$index]['meeting_hosts'] = $hostData;
            //    $data[$index]['meeting_participant'] = $participantData;
               $index++;
            }

            foreach ($data as $emailData) {
                $email = new MeetingEmail($emailData);
                Mail::to($emailData['email'])->send($email);
                sleep(5);
            }

        }
    }
}
