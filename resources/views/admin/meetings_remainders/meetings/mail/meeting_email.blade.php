<!DOCTYPE html>
<html>

<head>
    <title>Meeting Detail</title>
</head>

<body font-family: Arial, sans-serif;>
    @if (isset($emailData['isRemainder']) && $emailData['isRemainder'])
        <div
            style=" max-width: 500px; margin: 0 auto; padding: 20px; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">

            @if (isset($emailData['meeting_action']) && $emailData['meeting_action'] == 'Updated')
                <h1 style="color: #333; font-size: 24px; margin-bottom: 20px;">Remainder Updated</h1>
            @else
                <h1 style="color: #333; font-size: 24px; margin-bottom: 20px;">Reminder: Upcoming Meeting</h1>
            @endif
            <p style=" font-size: 16px; margin-bottom: 10px;"><span style="font-weight: bold;">Dear
                    {{ $emailData['employeeName'] }},</span>
            </p>
            <p style=" font-size: 16px; margin-bottom: 10px;">This is a friendly reminder about our upcoming meeting
                scheduled
                for <span
                    style="font-weight: bold;">{{ Carbon\Carbon::parse($emailData['remainderDate'])->toDateString() }}</span>
                at
                <span
                    style="font-weight: bold;">{{ Carbon\Carbon::parse($emailData['remainderDate'])->format('H:i:s') }}</span>.
            </p>

            <p style=" font-size: 16px; margin-bottom: 10px;">Ending Date and Time
                for <span
                    style="font-weight: bold;">{{ Carbon\Carbon::parse($emailData['remainderExpairyDate'])->toDateString() }}</span>
                at
                <span
                    style="font-weight: bold;">{{ Carbon\Carbon::parse($emailData['remainderExpairyDate'])->format('H:i:s') }}</span>.
            </p>
            <p style=" font-size: 16px; margin-bottom: 10px;"><strong>Remainder Details:</strong></p>
            <ul>
                <li><strong>Title:</strong>
                    {{ $emailData['remainderTitle'] }}
                </li>
                <li><strong>Date:</strong> {{ Carbon\Carbon::parse($emailData['remainderDate'])->toDateString() }}
                </li>
                <li><strong>Time:</strong> {{ Carbon\Carbon::parse($emailData['remainderDate'])->format('H:i:s') }}
                </li>
                <li><strong>Expiary Date:</strong>
                    {{ Carbon\Carbon::parse($emailData['remainderExpairyDate'])->toDateString() }}
                </li>
                <li><strong>Expiary Time:</strong>
                    {{ Carbon\Carbon::parse($emailData['remainderExpairyDate'])->format('H:i:s') }}
                </li>
                <li><strong>Remainder Type:</strong> {{ $emailData['remainderRemainderType'] }}</li>
                <li><strong>Issuing Authority:</strong> {{ $emailData['remainderIssuingAuthority'] }}</li>
                <li><strong>Remainder Type:</strong> {{ $emailData['remainderRemainderType'] }}</li>
                <li><strong>Detail:</strong> {{ $emailData['remainderDetail'] }}</li>
            </ul>
            <p style=" font-size: 16px; margin-bottom: 10px;">Please make sure to come prepared with any necessary
                documents,
                reports, or updates related to the agenda. Your
                active participation and input are highly valued.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;">If, for any reason, you are unable to attend the meeting,
                kindly
                inform me as soon as possible so that we can
                reschedule or make alternate arrangements if needed.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;">Should you have any questions or require further
                clarification
                before the meeting, please don't hesitate to reach
                out to me.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;">Looking forward to a productive session.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;"><strong>Best regards,</strong><br>{{ env('APP_NAME') }}
            </p>
        </div>
    @else
        <div
            style=" max-width: 500px; margin: 0 auto; padding: 20px; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">

            @if (isset($emailData['meeting_action']) && $emailData['meeting_action'] == 'Updated')
                <h1 style="color: #333; font-size: 24px; margin-bottom: 20px;">Meeting Updated</h1>
            @endif

            <h1 style="color: #333; font-size: 24px; margin-bottom: 20px;">Meeting Reminder: Upcoming Meeting</h1>

            <p style=" font-size: 16px; margin-bottom: 10px;"><span style="font-weight: bold;">Dear
                    {{ $emailData['name'] }},</span>
            </p>
            <p style=" font-size: 16px; margin-bottom: 10px;">This is a friendly reminder about our upcoming meeting
                scheduled
                for <span
                    style="font-weight: bold;">{{ Carbon\Carbon::parse($emailData['start_date_time'])->toDateString() }}</span>
                at
                <span
                    style="font-weight: bold;">{{ Carbon\Carbon::parse($emailData['start_date_time'])->format('H:i:s') }}</span>.
            </p>
            <p style=" font-size: 16px; margin-bottom: 10px;"><strong>Meeting Details:</strong></p>
            <ul>
                <li><strong>Meeting Title:</strong>
                    {{ $emailData['meeting_title'] }}
                </li>
                <li><strong>Date:</strong> {{ Carbon\Carbon::parse($emailData['start_date_time'])->toDateString() }}
                </li>
                <li><strong>Time:</strong> {{ Carbon\Carbon::parse($emailData['start_date_time'])->format('H:i:s') }}
                </li>
                <li><strong>Location:</strong> {{ $emailData['meeting_location'] }}</li>
                <li><strong>Agenda:</strong> {{ $emailData['meeting_detail'] }}</li>
            </ul>
            <p style=" font-size: 16px; margin-bottom: 10px;">Please make sure to come prepared with any necessary
                documents,
                reports, or updates related to the agenda. Your
                active participation and input are highly valued.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;">If, for any reason, you are unable to attend the meeting,
                kindly
                inform me as soon as possible so that we can
                reschedule or make alternate arrangements if needed.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;">Should you have any questions or require further
                clarification
                before the meeting, please don't hesitate to reach
                out to me.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;">Looking forward to a productive session.</p>
            <p style=" font-size: 16px; margin-bottom: 10px;"><strong>Best regards,</strong><br>{{ env('APP_NAME') }}
            </p>
        </div>
    @endif
</body>

</html>
