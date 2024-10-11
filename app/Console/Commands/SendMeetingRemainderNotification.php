<?php

namespace App\Console\Commands;

use App\Mail\MeetingEmail;
use App\Models\Meeting;
use App\Models\MeetingHostParticipant;
use App\Models\MeetingRemainderDateTime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendMeetingRemainderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:meeting_remainders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is used to send meeting remainder email on specific date and time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $meetings = Meeting::whereRaw("DATE_FORMAT(meeting_date_time, '%Y-%m-%d') >= ?", [Carbon::today()
            ->toDateString()])
            ->get();
       foreach ($meetings as $meeting) {
            $memberIds = MeetingHostParticipant::where('meeting_id', $meeting->id)->pluck("member_id");
            $members = DB::table('protocol_liaisons')->whereIn('id',$memberIds)->get();

            $meetingRemainders = MeetingRemainderDateTime::where('module_id',$meeting->id)->where('module_name','Meeting')->get();
            $currentDateTime = Carbon::now('Asia/Karachi');

            foreach ($meetingRemainders as $remainder) {
               if(Carbon::parse($remainder->date_time)->toDateString() ==  $currentDateTime->toDateString()){
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

                    $data[$index]['start_date_time'] = $meeting->meeting_date_time;
                    $data[$index]['end_date_time'] = $meeting->meeting_end_date_time;
                    $data[$index]['meeting_title'] = $meeting->meeting_title;
                    $data[$index]['meeting_location'] = $meeting->meeting_location;
                    $data[$index]['meeting_detail'] = $meeting->meeting_detail;
                    $index++;
                    }
                    // dump($data);
                    foreach ($data as $emailData) {
                        $email = new MeetingEmail($emailData);
                        Mail::to($emailData['email'])->send($email);
                        sleep(5);
                    }

                    sleep(10);
                    dump('done');
               }
            }


            // die;
            // $memberIds = MeetingHostParticipant::where('meeting_id', $meeting->id)->pluck("member_id");
            // $members = DB::table('protocol_liaisons')->whereIn('id',$memberIds)->get();

            // $hostData = [];
            // $hostIndex = 0;
            // foreach ($meeting->hosts as $host) {
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
            // foreach ($meeting->participants as $participant) {
            //     $member = DB::table('protocol_liaisons')->where('id',$participant->member_id)->first();
            //     if($participant->official_notable_type == 'Notable'){
            //         $participantData[$participantIndex]['email'] = $member->notable_email;
            //     }elseif($participant->official_notable_type == 'Official'){
            //         $participantData[$participantIndex]['email'] = $member->official_email;
            //     }
            //     $participantData[$participantIndex]['type'] = $participant->official_notable_type;
            //     $participantIndex++;
            // }

       }
    }
}
