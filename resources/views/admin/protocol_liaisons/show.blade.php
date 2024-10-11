@extends('layouts.app')
@section('protocol-liaison-active-class', 'active')
@section('content')

<style>
    .tab-2 .nav-tabs .nav-link.active{
        color: white !important;
    background-color: #a80000 !important;
    border-bottom-color: #a80000 !important;

    }
    .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
    border-color: transparent;
    color: #a80000 !important;
}
</style>


    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Protocol & Liaisons</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- Officials Container -->
                        <div id="official_container emp-profile" class="@if ($protocolLiaison->protocol_liaisontype_id != 1) d-none @endif">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">OFFICIAL Details</h5>
                                </div>
                            </div>
                            <hr>
                            <section class="container-z">
                                <div class="row d-lg-flex d-md-flex d-sm-block">
                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="row d-block d-sm-block d-md-block d-lg-flex">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div>
                                                    <?php
                                                    
                                                    use Illuminate\Support\Facades\Date;
                                                    
                                                    $officialPhoto = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::OFFICIAL, $protocolLiaison->id, 'official_photo');
                                                    $url = $officialPhoto->first() ? $officialPhoto->first()->file_url : '';
                                                    ?>
                                                    <a href="{{ $url }}" target="_blank">
                                                        <img width="200" height="200" src="{{ $url }}"
                                                            alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="row d-lg-flex d-md-flex d-sm-block">
                                                    <div class="col-md-12 col-sm-12 form-group">
                                                        <label>Name</label>
                                                        <h5>{{ $protocolLiaison->official_name }}</h5>
                                                        <hr class="py-0 my-0">
                                                    </div>

                                                    <div class="col-md-12 col-sm-12 form-group">
                                                        <label>Designation</label>
                                                        <h5>{{ $protocolLiaison->official_designation }}</h5>
                                                        <hr class="py-0 my-0">
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <label>Department</label>
                                                        <h5>{{ optional($protocolLiaison->department)->name }}</h5>
                                                    </div>
                                                </div>


                                                <div class="d-flex pb-sm-3 p-3 pt-sm-0 mt-sm-0">
                                                    <div class="col">
                                                        <a href="tel:+92" class="btn bg-info px-4 p-1 border none mt-1"><i
                                                                class="mdi mdi-phone text-light"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="tel:+92"
                                                            class="btn bg-success px-4 p-1 border none mt-1"><i
                                                                class="mdi mdi-whatsapp text-light"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="{{ $protocolLiaison->official_email }}"
                                                            class="btn bg-secondary px-4 p-1 border none mt-1"><i
                                                                class="mdi mdi-email-outline text-light"></i></a>
                                                    </div>


                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 co-sm-12">

                                        <div class="col">
                                            <div class="map" style="height: 250px;" id="offical_map"></div>

                                        </div>
                                    </div>
                                </div>

                            </section>

                            <!-- Biography and Contact Address =====================================-->
                            <hr>
                            <section>
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-12 border border-light mr-4">
                                        <div class="form-group mb-3">
                                            <h3 class="header-title pb-3">Official Biography</h3>
                                            <p class="text-justify">{{ $protocolLiaison->official_biography }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 border border-none bg-danger text-light">
                                        <div class="form-group mb-3">
                                            <h3 class="header-title pt-3">Official Address</h3>
                                            <h6>{{ $protocolLiaison->official_address }}</h6>
                                        </div>
                                        <hr>
                                        <div>
                                            <table class=" table-hover m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th></th>

                                                        <th>
                                                            <h4>Contact Numbers</h4>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($protocolLiaison->contacts))
                                                        @foreach ($protocolLiaison->contacts as $connect)
                                                            <tr>
                                                                <!-- <td>{{ $loop->iteration }}</td> -->
                                                                <td class="col-2"><span class="mdi mdi-phone"></span></td>

                                                                <td class="col-10">{{ ucfirst($connect->contact_numebr) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <!-- Members ===============================================-->
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h3 class="header-title pb-3">Members</h3>
                                </div>
                            </div>

                            <section class="container-z d-block">

                                <div class="d-flex">
                                    <div class="">
                                        <tbody>
                                            <div class="row">

                                                @if (isset($protocolLiaison->members))
                                                    @foreach ($protocolLiaison->members as $team)
                                                        <div
                                                            class="col-12 col-md-4 col-sm-6 col-xl-3 border solid ml-0 mx-0">
                                                            <div class="p-2">
                                                                <!-- <td>{{ $loop->iteration }}</td> -->
                                                                <td><a href="{{ $team->photo_url }}" target="_blank">
                                                                        <img width="100" height="100"
                                                                            src="{{ $team->photo_url }}"
                                                                            alt="{{ ucfirst($team->name) }}">
                                                                    </a></td>
                                                            </div>
                                                            <div class=" p-2 text-center">
                                                                <div class="font-weight-bold">{{ ucfirst($team->name) }}
                                                                </div>
                                                                <div>{{ ucfirst($team->Designation) }}</div>
                                                                <a href="tel:+92{{ ucfirst($team->contact_number) }}"
                                                                    class="btn bg-info px-5 p-1 border none mt-1"><i
                                                                        class="mdi mdi-phone text-light"></i></a>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </tbody>
                                    </div>

                                </div>
                            </section>



                            <hr>
                            <!-- Timeline ===============================================-->
                            <section class="container-z">
                                <h3 class="header-title pb-3">Timeline</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Visit Purpose</th>
                                                <th>Department</th>
                                                <th>Location</th>
                                                <th>Host</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                                <th>Visit Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($protocolLiaison->visits))
                                                @foreach ($protocolLiaison->visits as $visit)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ ucfirst($visit->purpose_of_visit) }}</td>
                                                        <td>{{ ucfirst(optional($visit->department)->name) }}</td>
                                                        <td>{{ ucfirst(optional($visit->location)->name) }}</td>
                                                        <td>{{ ucfirst(optional($visit->host)->full_name) }}</td>
                                                        <td>{{ ucfirst($visit->time_in) }}</td>
                                                        <td>{{ ucfirst($visit->time_out) }}</td>
                                                        <td>{{ ucfirst($visit->notes) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </section>
                        </div>




                        <!-- Notables Container -->
                        <div id="notable_container" class="@if ($protocolLiaison->protocol_liaisontype_id != 2) d-none @endif">

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Notable Details</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <?php
                                    $officialPhoto = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::NOTABLE, $protocolLiaison->id, 'notable_photo');
                                    $url = $officialPhoto->first() ? $officialPhoto->first()->file_url : '';
                                    ?>
                                    <a href="{{ $url }}" target="_blank">
                                        <img width="200" height="200" src="{{ $url }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Notable Name</label>
                                        <h5>{{ $protocolLiaison->notable_name }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Notable City/Town</label>
                                        <h5>{{ $protocolLiaison->notable_city }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Notable Email</label>
                                        <h5>{{ $protocolLiaison->notable_email }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <h5>{{ $protocolLiaison->notable_google_map_lat }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <h5>{{ $protocolLiaison->notable_google_map_lng }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="map" id="notable_map"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <label>Notable Biography</label>
                                <h6>{{ $protocolLiaison->notable_biography }}</h6>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <label>Notable Address</label>
                                <h6>{{ $protocolLiaison->notable_address }}</h6>
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Contact Numbers</h5>
                                </div>
                            </div>
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($protocolLiaison->contacts))
                                        @foreach ($protocolLiaison->contacts as $connect)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucfirst($connect->contact_numebr) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <hr>

                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Members</h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Contact Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($protocolLiaison->members))
                                            @foreach ($protocolLiaison->members as $team)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{ $team->photo_url }}" target="_blank">
                                                            <img width="100" height="100"
                                                                src="{{ $team->photo_url }}"
                                                                alt="{{ ucfirst($team->name) }}">
                                                        </a></td>
                                                    <td>{{ ucfirst($team->name) }}</td>
                                                    <td>{{ ucfirst($team->Designation) }}</td>
                                                    <td>{{ ucfirst($team->contact_number) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>


                        <!-- Company Container -->
                        <div id="company_container" class="@if ($protocolLiaison->protocol_liaisontype_id != 3) d-none @endif">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Company Details</h5>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <h5>{{ $protocolLiaison->company_name }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Company City/Town</label>
                                        <h5>{{ $protocolLiaison->company_city }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Company Email</label>
                                        <h5>{{ $protocolLiaison->company_email }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Company Webiste URL</label>
                                        <h5><a href="{{ $protocolLiaison->company_website }}"
                                                target="_blank">{{ $protocolLiaison->company_website }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <h5>{{ $protocolLiaison->company_google_map_lat }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <h5>{{ $protocolLiaison->company_google_map_lng }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="map" id="company_map"></div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group mb-3">
                                <label>About Company</label>
                                <h6>{{ $protocolLiaison->company_about }}</h6>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <label>Company Address</label>
                                <h6>{{ $protocolLiaison->company_address }}</h6>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Company Photo</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <?php
                                    $officialPhotos = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::COMPANY, $protocolLiaison->id, 'company_photos');
                                    
                                    ?>
                                    <div class="row">
                                        @forelse ($officialPhotos as $attchment)
                                            @if (
                                                $attchment->file_type == 'png' ||
                                                    $attchment->file_type == 'jpg' ||
                                                    $attchment->file_type == 'jpeg' ||
                                                    $attchment->file_type == 'gif')
                                                <div class="col">
                                                    <a target="_blank" href="{{ $attchment->file_url }}">
                                                        <img src="{{ $attchment->file_url }}" width="100"
                                                            height="100" alt="{{ $attchment->orignal_file_name }}">
                                                    </a>
                                                    <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                                </div>
                                            @elseif($attchment->file_type == 'pdf')
                                                <div class="col">
                                                    <a target="_blank" href="{{ $attchment->file_url }}"
                                                        style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                                    <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                                </div>
                                            @elseif($attchment->file_type == 'xls')
                                                <div class="col">
                                                    <a target="_blank" href="{{ $attchment->file_url }}"
                                                        style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                                    <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                                </div>
                                            @endif
                                        @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Contact Numbers</h5>
                                </div>
                            </div>
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($protocolLiaison->contacts))
                                        @foreach ($protocolLiaison->contacts as $connect)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucfirst($connect->contact_numebr) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <hr>

                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Members</h5>
                                </div>
                            </div>
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Contact Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($protocolLiaison->members))
                                        @foreach ($protocolLiaison->members as $team)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ $team->photo_url }}" target="_blank">
                                                        <img width="100" height="100" src="{{ $team->photo_url }}"
                                                            alt="{{ ucfirst($team->name) }}">
                                                    </a></td>
                                                <td>{{ ucfirst($team->name) }}</td>
                                                <td>{{ ucfirst($team->Designation) }}</td>
                                                <td>{{ ucfirst($team->contact_number) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <hr>
                        </div>
                        <div class="row" id="by_road_cargo_photos_fileContainer"></div>


                        <!-- PROJECT FROM HERE======================= -->
                        <div id="project_container" class="@if ($protocolLiaison->protocol_liaisontype_id != 4) d-none @endif">
                            <div class="row">
                                <div class="col-xl-12 text-center">
                                    <img style="max-width: 50%;" src="{{ $protocolLiaison->project_feature_image_url }}"
                                        alt="">
                                </div>
                            </div>
                            <hr>
                            <div class="col">
                                <div class="form-group">
                                    <!-- <label>Project Name</label> -->
                                    <h1>{{ $protocolLiaison->project_name }}</h1>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="row mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <label>Project Location</label>
                                        <h5>{{ optional($protocolLiaison->location)->name }}</h5>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Project Webiste URL</label>
                                        <h5>
                                            <a href="{{ $protocolLiaison->project_website }}"
                                                target="_blank">{{ $protocolLiaison->project_website }}</a>
                                        </h5>
                                    </div>
                                    <hr>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <h5 class="header-title pb-0">Contact Numbers</h5>
                                        </div>
                                    </div>
                                    <hr class="my-1">
                                    <table class=" table-hover m-b-0">
                                        <tbody>
                                            @if (isset($protocolLiaison->contacts))
                                                @foreach ($protocolLiaison->contacts as $connect)
                                                    <tr>
                                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                                        <td class="col-2">
                                                            <span class="mdi mdi-phone"></span>
                                                        </td>
                                                        <td class="col-10">{{ ucfirst($connect->contact_numebr) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <hr>
                                </div>
                                <hr>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <label>Project No.</label>
                                        <h5>{{ $protocolLiaison->project_email }}</h5>
                                    </div>
                                    <hr>
                                    <div class="form-group mb-3">
                                        <label>Project Address</label>
                                        <h6>{{ $protocolLiaison->project_address }}</h6>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="map" id="project_map"></div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group mb-3">
                                <h5 class="header-title pb-3">About Project</h5>
                                <h6>{{ $protocolLiaison->project_company_about }}</h6>
                            </div>
                            <!-- <div class="form-group mb-3"><label>Project Address</label><h6>{{ $protocolLiaison->project_address }}</h6></div> -->
                            <hr>
                            <div class="form-group mb-3">
                                <h5 class="header-title pb-3">Project Description</h5>
                                <h6>{{ $protocolLiaison->project_description }}</h6>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Project Photo</h5>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <?php
                                        $officialPhotos = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::PROJECT, $protocolLiaison->id, 'project_photos');
                                        
                                        ?>
                                        <div class="row">
                                            @forelse ($officialPhotos as $attchment)
                                                @if (
                                                    $attchment->file_type == 'png' ||
                                                        $attchment->file_type == 'jpg' ||
                                                        $attchment->file_type == 'jpeg' ||
                                                        $attchment->file_type == 'gif')
                                                    <div class="col">
                                                        <a target="_blank" href="{{ $attchment->file_url }}">
                                                            <img src="{{ $attchment->file_url }}" width="100"
                                                                height="100" alt="{{ $attchment->orignal_file_name }}">
                                                        </a>
                                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}
                                                        </p>
                                                    </div>
                                                @elseif($attchment->file_type == 'pdf')
                                                    <div class="col">
                                                        <a target="_blank" href="{{ $attchment->file_url }}"
                                                            style="font-size: 100px"><i
                                                                class="mdi mdi-file-pdf-box"></i></a>
                                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}
                                                        </p>
                                                    </div>
                                                @elseif($attchment->file_type == 'xls')
                                                    <div class="col">
                                                        <a target="_blank" href="{{ $attchment->file_url }}"
                                                            style="font-size: 100px"><i
                                                                class="mdi mdi-file-excel"></i></a>
                                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}
                                                        </p>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="col">
                                                    <p style="font-weight: bolder">N/A</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h3 class="header-title pb-3">Team Members</h3>
                                </div>
                            </div>
                            <section class="container-z d-block">
                                <tbody>
                                    <div class="row d-flex justify-content-around">
                                        @if (isset($protocolLiaison->members))
                                            @foreach ($protocolLiaison->members as $team)
                                                <div class="col-6 col-md-4 col-sm-6 col-xl-3 border solid ml-0 mx-0 ">
                                                    <div class="p-2">
                                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                                        <td>
                                                            <a href="{{ $team->photo_url }}" target="_blank">
                                                                <img width="100" height="100"
                                                                    src="{{ $team->photo_url }}"
                                                                    alt="{{ ucfirst($team->name) }}">
                                                            </a>
                                                        </td>
                                                    </div>
                                                    <div class=" p-2 text-center">
                                                        <div class="font-weight-bold">{{ ucfirst($team->name) }}
                                                        </div>
                                                        <div>{{ ucfirst($team->Designation) }}</div>
                                                        <a href="tel:+92{{ ucfirst($team->contact_number) }}"
                                                            class="btn bg-info px-5 p-1 border none mt-1">
                                                            <i class="mdi mdi-phone text-light"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </tbody>
                            </section>
                            <!-- TIMELINE======== -->
                            <hr>
                            <h2 class=" py-2 text-center bg-danger rounded text-white align-items-center">Activities</h2>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="card-body">
                                        <div id="user-activities" class="tab-pane">
                                            <div class="timeline-2">
                                                <div class="time-item">
                                                    <div class="item-info row"> <?php
                                                    $officialPhotos = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::PROJECT, $protocolLiaison->id, 'project_photo');
                                                    
                                                    ?> @forelse ($officialPhotos as $attchment)
                                                            @if (
                                                                $attchment->file_type == 'png' ||
                                                                    $attchment->file_type == 'jpg' ||
                                                                    $attchment->file_type == 'JPG' ||
                                                                    $attchment->file_type == 'jpeg' ||
                                                                    $attchment->file_type == 'gif')
                                                                <div class="col-md-3">
                                                                    <a target="_blank" href="{{ $attchment->file_url }}">
                                                                        <img src="{{ $attchment->file_url }}"
                                                                            width="100%" height="50%"
                                                                            alt="{{ $attchment->orignal_file_name }}">
                                                                    </a>
                                                                    <h4 style="margin-left: 27px; margin-top: 20px">
                                                                        <strong>{{ $attchment->file_name }}</strong>
                                                                    </h4>
                                                                    <p style="margin-left: 27px">
                                                                        {{ $attchment->notes }}
                                                                    </p>
                                                                    <p style="margin-left: 27px">Uploaded By:
                                                                        <strong>{{ $attchment->user->full_name }} @
                                                                            {{ $attchment->created_at }}</strong>
                                                                    </p>
                                                                </div>
                                                            @elseif($attchment->file_type == 'pdf')
                                                                <div class="col-md-3">
                                                                    <a target="_blank" href="{{ $attchment->file_url }}"
                                                                        style="font-size: 100px">
                                                                        <i class="mdi mdi-file-pdf-box text-danger"></i>
                                                                    </a>
                                                                    <p style="margin-left: 27px; margin-top: 20px">File
                                                                        Name: <strong>{{ $attchment->file_name }}</strong>
                                                                    </p>
                                                                    <p style="margin-left: 27px">Notes:
                                                                        <strong>{{ $attchment->notes }}</strong>
                                                                    </p>
                                                                    <p style="margin-left: 27px">Uploaded By:
                                                                        <strong>{{ $attchment->user->full_name }} @
                                                                            {{ $attchment->created_at }}</strong>
                                                                    </p>
                                                                </div>
                                                            @elseif($attchment->file_type == 'xls')
                                                                <div class="col-md-3">
                                                                    <a target="_blank" href="{{ $attchment->file_url }}"
                                                                        style="font-size: 100px">
                                                                        <i class="mdi mdi-file-excel text-primary"></i>
                                                                    </a>
                                                                    <p style="margin-left: 27px; margin-top: 20px">File
                                                                        Name: <strong>{{ $attchment->file_name }}</strong>
                                                                    </p>
                                                                    <p style="margin-left: 27px">Notes:
                                                                        <strong>{{ $attchment->notes }}</strong>
                                                                    </p>
                                                                    <p style="margin-left: 27px">Uploaded By:
                                                                        <strong>{{ $attchment->user->full_name }} @
                                                                            {{ $attchment->created_at }}</strong>
                                                                    </p>
                                                                </div>
                                                            @endif @empty <div class="col">
                                                                <p style="font-weight: bolder">N/A</p>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- TIMELINE END============ -->
                                <hr>
                            </div>
                            <div class="row" id="by_road_cargo_photos_fileContainer"></div>
                        </div>


                        <!-- PROPERTY ======================== -->

                        <div id="property_container" class="@if ($protocolLiaison->protocol_liaisontype_id != 5) d-none @endif bg-light">
                            <div class="row mt-5 text-center">
                                <div class="col-xl-12 ">
                                    <img style="max-width: 100%;"
                                        src="{{ $protocolLiaison->project_feature_image_url }}" alt="">
                                    <hr>
                                    <h2>{{ $protocolLiaison->property_name }}</h2>

                                </div>

                            </div>

                            <!-- sidebar left start-->


                            <div class="page-head"></div>
                            <div class="row">

                                <div class="col-lg-12 col-sm-12">
                                    <div class="card-title tab-2">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#about" data-toggle="tab"
                                                    aria-expanded="false"><i class="ti-user mr-2"></i>About</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#photo" data-toggle="tab"
                                                    aria-expanded="false"><i class="ti-image mr-2"></i>Photos</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#settings" data-toggle="tab"
                                                    aria-expanded="false"><i class="ti-settings mr-2"></i>Inventory</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content p-4 bg-white">

                                            <div class="tab-pane active p-4" id="about">
                                                <div class="row mt-5 justify-content-center">
                                                    <div class="col-md-6  profile-detail">
                                                        <div class="text-left">
                                                            <div>
                                                                <p>{{ $protocolLiaison->property_company_about }} </p>
                                                                @error('property_company_about')
                                                                    <span class="error">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <hr>
                                                            <div>
                                                                <h5>Property Description</h5>
                                                                <p>{{ $protocolLiaison->property_description }}</p>
                                                                @error('property_description')
                                                                    <span class="error">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class="col-md-12">
                                                            <div class="presonal-inform">
                                                                <div class="form-group">
                                                                    <label>Property City/Town</label>
                                                                    <p>{{ $protocolLiaison->property_city }}</p>
                                                                    @error('property_city')
                                                                        <span class="error">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!--END ROW-->
                                                    <hr>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Latitude</label>
                                                            <input type="number" name="property_google_map_lat"
                                                                class="form-control" readonly
                                                                value="{{ $protocolLiaison->property_google_map_lat }}"
                                                                placeholder="Latitude" step=".0000000000000001" />
                                                            @error('property_google_map_lat')
                                                                <span class="error">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Longitude</label>
                                                            <input type="number" name="property_google_map_lng"
                                                                class="form-control" readonly
                                                                value="{{ $protocolLiaison->property_google_map_lng }}"
                                                                placeholder="Longitude" step=".0000000000000001" />
                                                            @error('property_google_map_lng')
                                                                <span class="error">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <h5 class="header-title pb-3">Activities</h5>
                                                <div id="user-activities" class="tab-pane">
                                                    <div class="timeline-2">
                                                        <div class="time-item">
                                                            <div class="item-info">
                                                                <div class="text-muted">5 minutes ago</div>
                                                                <p><strong><a href="#" class="text-info">Robert
                                                                            Carlile</a></strong> Uploaded a photo
                                                                    <strong>"DSC000586.jpg"</strong>
                                                                </p>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="photo">
                                                <div class="row ">
                                                    <div class="item-box">
                                                        <?php
                                                        $propertyPhoto = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::PROPERTY, $protocolLiaison->id, 'property_photos');
                                                        ?>
                                                        <div class="row">
                                                            @forelse ($propertyPhoto as $attchment)
                                                                @if (
                                                                    $attchment->file_type == 'png' ||
                                                                        $attchment->file_type == 'jpg' ||
                                                                        $attchment->file_type == 'jpeg' ||
                                                                        $attchment->file_type == 'gif')
                                                                    <div class="col-lg-3 col-md-4 col-6">
                                                                        <a target="_blank"
                                                                            href="{{ $attchment->file_url }}">
                                                                            <img src="{{ $attchment->file_url }}"
                                                                                width="100%" height="100%"
                                                                                alt="{{ $attchment->orignal_file_name }}">
                                                                        </a>
                                                                        <!-- <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p> -->
                                                                    </div>
                                                                @elseif($attchment->file_type == 'pdf')
                                                                    <div class="col-lg-3 col-md-4 col-6">
                                                                        <a target="_blank"
                                                                            href="{{ $attchment->file_url }}"
                                                                            style="font-size: 100px"><i
                                                                                class="mdi mdi-file-pdf-box"></i></a>
                                                                        <p style="margin-left: 27px">
                                                                            {{ $attchment->orignal_file_name }}
                                                                        </p>
                                                                    </div>
                                                                @elseif($attchment->file_type == 'xls')
                                                                    <div class="col-lg-3 col-md-4 col-6">
                                                                        <a target="_blank"
                                                                            href="{{ $attchment->file_url }}"
                                                                            style="font-size: 100px"><i
                                                                                class="mdi mdi-file-excel"></i></a>
                                                                        <p style="margin-left: 27px">
                                                                            {{ $attchment->orignal_file_name }}
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            @empty
                                                                <div class="col-lg-3 col-md-4 col-6">
                                                                    <p style="font-weight: bolder">N/A</p>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="settings">
                                                <div class="row">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!--end row-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY" type="text/javascript">
    </script>
    <script>
        var officiallat = "{{ $protocolLiaison->official_google_map_lat }}";
        var officiallng = "{{ $protocolLiaison->official_google_map_lng }}";


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


        var notablelat = "{{ $protocolLiaison->notable_google_map_lat }}";
        var notablelng = "{{ $protocolLiaison->notable_google_map_lng }}";


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


        var companylat = "{{ $protocolLiaison->company_google_map_lat }}";
        var companylng = "{{ $protocolLiaison->company_google_map_lng }}";


        const company_map = new google.maps.Map(document.getElementById("company_map"), {
            center: {
                lat: companylat ? parseFloat(companylat) : 31.475887326841583,
                lng: companylng ? parseFloat(companylng) : 74.34262564095089
            },
            zoom: 18,
        });

        const company_marker = new google.maps.Marker({
            map: company_map,
            position: {
                lat: companylat ? parseFloat(companylat) : 31.475887326841583,
                lng: companylng ? parseFloat(companylng) : 74.34262564095089
            },
        });

        var projectlat = "{{ $protocolLiaison->project_google_map_lat }}";
        var projectlng = "{{ $protocolLiaison->project_google_map_lng }}";


        const project_map = new google.maps.Map(document.getElementById("project_map"), {
            center: {
                lat: projectlat ? parseFloat(projectlat) : 31.475887326841583,
                lng: projectlng ? parseFloat(projectlng) : 74.34262564095089
            },
            zoom: 11,
        });

        const project_marker = new google.maps.Marker({
            map: project_map,
            position: {
                lat: projectlat ? parseFloat(projectlat) : 31.475887326841583,
                lng: projectlng ? parseFloat(projectlng) : 74.34262564095089
            },
        });


        {
            {
                --
                var propertylat = "{{ $protocolLiaison->property_google_map_lat }}";
                var propertylng = "{{ $protocolLiaison->property_google_map_lng }}";


                const property_map = new google.maps.Map(document.getElementById("property_map"), {
                    center: {
                        lat: propertylat ? parseFloat(propertylat) : 31.475887326841583,
                        lng: propertylng ? parseFloat(propertylng) : 74.34262564095089
                    },
                    zoom: 18,
                });

                const property_marker = new google.maps.Marker({
                    map: property_map,
                    position: {
                        lat: propertylat ? parseFloat(propertylat) : 31.475887326841583,
                        lng: propertylng ? parseFloat(propertylng) : 74.34262564095089
                    },
                });
                --
            }
        }
    </script>
@endsection
