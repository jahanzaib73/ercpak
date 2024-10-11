@extends('layouts.app')
@section('guest-vistor-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="page-head">
                <h4 class="mt-2 mb-2">Guest & Customer Detail</h4>
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('guest.visitor.generate.report', ['id' => $guest_visitor->id]) }}"
                    class="btn save-btn">Generate Report</a>
                {{--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal">
                    Print
                </button>  --}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">



                        <div id="guest_container">
                            {{--  @if ($guest_visitor->type == App\Models\GuestVistor::GUEST)  --}}
                            <div class=@if ($guest_visitor->type == App\Models\GuestVistor::VISTORS) "d-none" @endif>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">GUEST Details</h5>
                                    </div>
                                </div>

                                <div class="row m-5">
                                    <div class="col-lg-12">
                                        <div class="col">
                                            <div class="map" style="height: 250px;" id="offical_map"></div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Guest</label>
                                            @if ($guest_visitor->guest && $guest_visitor->guest->official_name)
                                                <h5>{{ optional($guest_visitor->guest)->official_name . ' (Official)' }}
                                                </h5>
                                            @else
                                                <h5>{{ optional($guest_visitor->guest)->notable_name . ' (Notable)' }}
                                                </h5>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Purpose of Visit</label>
                                            <h5>{{ optional($guest_visitor->pyrposeOfVisit)->name }}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Passport Number</label>
                                            <h5>{{ $guest_visitor->passport_number }}</h5>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                            </div>
                            {{--  @else  --}}
                            <div class=@if ($guest_visitor->type == App\Models\GuestVistor::GUEST) "d-none" @endif>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Customer Details</h5>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <div class="map" id="notable_map"></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <img style="max-width: 10%" src="{{ $guest_visitor->image_url }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <h5>{{ $guest_visitor->vistor_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Email</label>
                                            <h5>{{ $guest_visitor->vistor_email }}</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Contact</label>
                                            <h5>{{ $guest_visitor->vistor_contact }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Purpose of Visit</label>
                                            <h5>{{ $guest_visitor->purpose_of_visit }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <h5>{{ $guest_visitor->province_id }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <h5>{{ $guest_visitor->city_id }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Customer Address</label>
                                            <h5>{{ $guest_visitor->address }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            {{--  @endif  --}}
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Visit Details</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Currency</label>
                                        <h5>{{ $guest_visitor->currency }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fee</label>
                                        <h5>{{ $guest_visitor->fee }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <h5>{{ optional($guest_visitor->department)->name }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <h5>{{ optional($guest_visitor->location)->name }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Host</label>
                                        <h5>{{ optional($guest_visitor->host)->full_name }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <h5>{{ $guest_visitor->lat }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <h5>{{ $guest_visitor->lng }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time In</label>
                                        <h5>{{ $guest_visitor->time_in }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time Out</label>
                                        <h5>{{ $guest_visitor->time_out }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Visit Details</label>
                                <h5>{{ $guest_visitor->notes }}</h5>
                            </div>

                            <hr>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Attachment List</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Attachment</th>
                                                    <th>Attachment Job#</th>
                                                    <th>Expiary Date</th>
                                                    <th>File Name</th>
                                                    <th>Created By</th>
                                                    <th>Guest/Visitor Name</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($guest_visitor->attachments as $attachment)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a href="{{ $attachment->file_url }}" target="_blank">
                                                                <i class="fa fa-file" style="font-size: 40px"></i>
                                                            </a>
                                                        </td>

                                                        <td>{{ $attachment->id }}</td>
                                                        <td>{{ $attachment->expiary_date }}</td>
                                                        <td>{{ ucwords($attachment->file_name) }}</td>
                                                        <td>{{ optional($attachment->user)->full_name }}</td>
                                                        <td>{{ $attachment->guest_visitor_id }}</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $attachment->status == 1 ? 'success' : 'info' }}">
                                                                {{ $attachment->status == 1 ? 'Closed' : 'Inprogress' }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
    <div class="modal fade bd-example-modal-lg  mydivtoprint" tabindex="-1" role="dialog" id="printModal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row d-flex pt-4 text-center button-act">
                    <div class="col"></div>
                    <div class="col">
                        <button class="btn btn-default" id="printReport"><i class="fa fa-print" aria-hidden="true"
                                style="font-size: 17px;"> Print</i></button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                    </div>
                </div>

                <div class="ReportOfGuestAndVisitor">


                    <div class="container pt-5 bimagec">

                        <div class="container pt-5 b-image">

                            <div style="text-align: center;">
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex;">
                                        <div>
                                            <img src=" {{ $guest_visitor->type == 'GUEST' ? (optional($guest_visitor->guest)->official_name ? optional(optional($guest_visitor->guest)->officialImage)->file_url : optional(optional($guest_visitor->guest)->officialImage)->file_url) : $guest_visitor->image_url }}"
                                                alt="Customer Photo" style="max-width: 100px; height: auto;">


                                        </div>
                                        <div style="text-align: left;">

                                            <h6>Name:
                                                {{ $guest_visitor->type == 'GUEST' ? (optional($guest_visitor->guest)->official_name ? optional($guest_visitor->guest)->official_name : optional($guest_visitor->guest)->notable_name) : $guest_visitor->vistor_name }}
                                            </h6>

                                            <h6>Mobile Number:
                                                {{ $guest_visitor->vistor_contact ? $guest_visitor->vistor_contact : 'N/A' }}
                                            </h6>

                                            <h6>Email:
                                                {{ $guest_visitor->type == 'GUEST' ? (optional($guest_visitor->guest)->official_email ? optional($guest_visitor->guest)->official_email : optional($guest_visitor->guest)->notable_email) : $guest_visitor->vistor_email }}
                                            </h6>

                                            <h6>Passport#: {{ $guest_visitor->passport_number }}</h6>

                                        </div>

                                    </div>
                                    <div style="text-align: left;">
                                        <h2><strong>INVOICE</strong></h2>
                                        <h3>INV #: {{ $guest_visitor->id }}</h3>
                                        <h6>Date: &nbsp;&nbsp;
                                            {{ Carbon\Carbon::parse($guest_visitor->time_in)->toDateString() }}
                                        </h6>
                                        <div style="margin-left: 10px">
                                            <center>
                                                <div class="mb-3">{!! DNS1D::getBarcodeHTML("$guest_visitor->id", 'C39') !!}</div>
                                            </center>
                                        </div>
                                    </div>
                                </div>



                                <table border="1" style="width: 100%; margin-top: 20px;">
                                    <tr>
                                        <th style="padding-bottom: 15px; padding-top: 15px;">Type</th>
                                        <th>Payment Details</th>
                                        <th>Amount</th>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 15px; padding-top: 15px;">
                                            {{ optional($guest_visitor->pyrposeOfVisit)->name }}</td>
                                        <td>{{ optional($guest_visitor->pyrposeOfVisit)->name }}</td>
                                        <td>{{ $guest_visitor->currency }}
                                            {{ number_format($guest_visitor->fee, 2) }}</td>
                                    </tr>
                                </table>


                            </div>
                        </div>

                        <br>
                        <div>
                            <h5 style="padding-bottom: 10px;">Note:</h5>

                            <h6>1. Non Refundable.</h6>
                            <h6>2. Rules & Regulations will be applied as per UAE Government Law.</h6>
                            <h6>3. Please bring original receipt at the time of collection.</h6>
                            <h6>4. Please collect your passport within 14 days after the consulate general will never
                                responsible.</h6>
                            <h6>5. This receipt for office record only</h6>

                        </div>


                        <div style="width: 100%; display: flex; justify-content: flex-end;">
                            <table style="width: 50%; margin-top: 20px; margin-right: 0%; ">
                                <thead style="border: 1px solid;">
                                    <th style="background-color: gainsboro; padding-top: 15px; padding-bottom: 15px;"></th>
                                    <th style="background-color: gainsboro; padding-top: 20px; padding-bottom: 15px;">
                                        Acknowledged By</th>
                                </thead>
                                <tbody>
                                    <tr style="border: 1px solid;">
                                        <td style="width:40%; border: 1px solid; padding-bottom: 15px; padding-top: 15px;">
                                            Accounts</td>
                                        <td style="width:60%; border: 1px solid; padding-bottom: 15px; padding-top: 15px;">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid;">
                                        <td style="border: 1px solid; padding-top: 15px; padding-bottom: 15px; width:40%;">
                                            DDV
                                        </td>
                                        <td style="border: 1px solid; padding-bottom: 15px; width:60%; padding-top: 15px;">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid;">
                                        <td style="width:40%; border: 1px solid; padding-top: 15px; padding-bottom: 15px;">
                                            Biometric</td>
                                        <td style="width:60%; border: 1px solid; padding-bottom: 15px; padding-top: 15px;">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid;">
                                        <td style="width:40%; border: 1px solid; padding-top: 15px; padding-bottom: 15px;">
                                            Interview</td>
                                        <td style="width:60%; border: 1px solid; padding-bottom: 15px; padding-top: 15px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="text-align: left; margin-top: 20px; margin-left: 5px">
                        <p> Printed by: {{ Auth::user()->full_name }} @ {{ Carbon\Carbon::now()->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe id="print-frame" style="display: none;"></iframe>  --}}

    {{--  </div>
    </div>
    </div>  --}}
@endsection

@section('script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY" type="text/javascript">
    </script>
    <script>
        {{--  $(document).ready(function() {
            $("#printReport").on("click", function() {
                var printableContent = $(".ReportOfGuestAndVisitor").html();
                var printFrame = $("#print-frame");

                printFrame.one("load", function() {
                    var printDocument = printFrame[0].contentWindow.document;
                    printDocument.body.innerHTML = printableContent;

                    // Wait for the iframe's content to load
                    setTimeout(function() {
                        printFrame[0].contentWindow.print();
                    }, 1000); // Adjust the delay as needed
                });

                printFrame.attr("src", "about:blank");
            });
        });  --}}

        var officiallat = "{{ $guest_visitor->lat }}";
        var officiallng = "{{ $guest_visitor->lng }}";

        const offical_map = new google.maps.Map(document.getElementById("offical_map"), {
            center: {
                lat: officiallat ? parseFloat(officiallat) : 31.475887326841583,
                lng: officiallng ? parseFloat(officiallng) : 74.34262564095089
            },
            zoom: 12,
        });

        const offical_marker = new google.maps.Marker({
            map: offical_map,
            position: {
                lat: officiallat ? parseFloat(officiallat) : 31.475887326841583,
                lng: officiallng ? parseFloat(officiallng) : 74.34262564095089
            },
        });


        var notablelat = "{{ $guest_visitor->lat }}";
        var notablelng = "{{ $guest_visitor->lng }}";
        const notable_map = new google.maps.Map(document.getElementById("notable_map"), {
            center: {
                lat: notablelat ? parseFloat(notablelat) : 31.475887326841583,
                lng: notablelng ? parseFloat(notablelng) : 74.34262564095089
            },
            zoom: 18,
        });

        const notable_marker = new google.maps.Marker({
            map: notable_map,
            position: {
                lat: notablelat ? parseFloat(notablelat) : 31.475887326841583,
                lng: notablelng ? parseFloat(notablelng) : 74.34262564095089
            },
        });
    </script>
@endsection
