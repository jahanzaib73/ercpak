@extends('layouts.app')
@section('user-active-class', 'active')
@section('content')


<style>

    .nav-link.active{
        color: white !important;
    background-color: #a80000 !important;
    border-bottom-color: #fff !important;

    }

   .nav-link:hover {
    border-color: transparent;
    color: #d4d4d4 !important;
}
</style>
    <div class="container-fluid">

        <!-- ===================================================================== -->

        <div class="container-fluid">
            <div class="page-head"></div>
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <div class="card m-b-30 border-0">
                        <div class="row text-center text-white profile-block" style="height: 100px;">
                            <div class="col-4 align-self-center">
                                <a href="{{ $user->contact_number }}">
                                    <i class="fa fa-phone"></i>
                                </a>
                            </div>
                            <div class="col-4 ml-auto align-self-center">
                                <a href="{{ $user->whats_app_number }}">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body pro-img mx-auto text-center">
                            <img src="{{ $user->profile_pic_url }}" alt="" class="rounded-circle mx-auto d-block">
                        </div>
                        <div class="text-center">
                            <h5>{{ $user->first_name }} &nbsp; {{ $user->last_name }}</h5>
                            <p class="text-muted">{{ optional($user->designation)->name }}</p>
                            <p class="text-muted p-2">About me here</p>
                        </div>

                        <div class="row text-center profile-block">
                            <div class="col-6 align-self-center py-3 border-right">
                                <p class="profile-count">---</p>
                                <p class="mb-0">Job Entries</p>
                            </div>

                            <div class="col-6 align-self-center py-3 border-right">
                                <h5 class="text-info">{{ $user->employee_type }}</h5>
                                <hr class="my-0">
                                <h5>{{ $user->employee_sub_type }}</h5>
                            </div>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30 contact">
                                <div class="card-body">
                                    <h6 class="header-title pb-3">Contact</h6>
                                    <ul class="list-unstyled">
                                        <li class=""><i class="fa fa-phone mr-2"></i> <b> phone </b> :
                                            {{ $user->contact_number }}</li>
                                        <li class="mt-2"><i class="fa fa-envelope-o mt-2 mr-2"></i> <b> Email </b> :
                                            {{ $user->email }}</li>
                                        <li class="mt-2"><i class="fa fa-whatsapp mt-2 mr-2"></i> <b>WhatsApp</b> :
                                            {{ $user->whats_app_number }}</li>
                                        <li class="mt-2"><i class="fa fa-map-marker mt-2 mr-2"></i> <b>Location</b> :
                                            {{ optional($user->country)->name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30 contact">
                                <div class="card-body">
                                    <h6 class="header-title pb-3">Leave Quota</h6>
                                    <ul class="list-unstyled">
                                        <li class=""><i class="fa  fa-file-o mr-2"></i> <b> Leaves </b> :
                                            {{ $user->leaves }}</li>
                                        <li class=""><i class="fa  fa-file-o mr-2"></i> <b> Applied </b> :
                                            {{ $user->getLeavesCount() }}</li>
                                        <li class=""><i class="fa  fa-file-o mr-2"></i> <b> Balance </b> :
                                            {{ $user->getLeavesBalance() }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30 contact">
                                <div class="card-body">
                                    <h6 class="header-title pb-3">Wages Details</h6>
                                    <ul class="list-unstyled">
                                        <li class=""><i class="fa fa-phone mr-2"></i> <b> Wages Type </b> :
                                            {{ $user->wages_type }}</li>
                                        <li class="mt-2"><i class="fa fa-envelope-o mt-2 mr-2"></i> <b> Wages </b> :
                                            {{ $user->wages_type_value }}</li>
                                        <li class="mt-2"><i class="fa fa-whatsapp mt-2 mr-2"></i> <b>Cost Center</b> :
                                            {{ optional($user->costCenter)->title }}</li>
                                        <li class="mt-2"><i class="fa fa-map-marker mt-2 mr-2"></i> <b>Location</b> :
                                            {{ optional($user->country)->name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30 contact">
                                <div class="card-body">
                                    <h6 class="header-title pb-3">Other Details</h6>
                                    @foreach ($user->allowances as $allowance)
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p>{{ $allowance->name }} &nbsp; :</p>
                                            </div>
                                            <div>
                                                <p><strong> {{ $allowance->amount }}</strong></p>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="d-flex justify-content-center bg-danger px-4 py-2">
                                <a class="text-white " href="\users/edit/">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-lg-9 col-sm-12">
                    <div class="card-title tab-2">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#about" data-toggle="tab" aria-expanded="false"><i
                                        class="ti-user mr-2"></i>About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#photo" data-toggle="tab" aria-expanded="false"><i
                                        class="ti-image mr-2"></i>Activities / Timeline</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#settings" data-toggle="tab" aria-expanded="false"><i
                                        class="ti-settings mr-2"></i>Assigned Tasks</a>
                            </li>
                        </ul>
                        <div class="tab-content p-4 bg-white">
                            <div class="tab-pane home-text p-4" id="home-6">
                                <img src="assets/images/logo_sm.png" alt="">
                                <h1>Syntra Admin Template</h1>
                                <h4 class="text-muted">Sociis natoque penatibus et magnis dis parturient montes.</h4>
                            </div>

                            <!-- ABOUT========== -->

                            <div class="tab-pane active p-4" id="about">
                                <div class="card-title tab-2">

                                    <div class="tab-content p-4 bg-white">

                                        <div class="tab-pane active p-4" id="about">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12  profile-detail">
                                                    <div class="text-center">
                                                        <i class="fa fa-graduation-cap"></i>
                                                        <h5>Personal Details</h5>
                                                        <div class="profile-border my-3"></div>
                                                        <p class="detail-text">{{ $user->notes }}</p>

                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-12">
                                                            <div class="presonal-inform">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-7">

                                                                        <table class="table table-hover">

                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>Name:</th>
                                                                                    <th>{{ $user->first_name }} &nbsp;
                                                                                        {{ $user->last_name }}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Date of Birth:</th>
                                                                                    <th>6 January 1987</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Address:</th>
                                                                                    <th>{{ $user->address }}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Province:</th>
                                                                                    <th>{{ optional($user->province)->name }}
                                                                                    </th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-12 col-md-5">

                                                                        <table class="table table-hover">

                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>Phone:</th>
                                                                                    <th>{{ $user->contact_number }}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Email:</th>
                                                                                    <th>{{ $user->email }}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>City:</th>
                                                                                    <th>{{ optional($user->city)->name }}
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Country:</th>
                                                                                    <th>{{ optional($user->country)->name }}
                                                                                    </th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div><!--END ROW-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==============TIMELINE=============== -->

                            <div class="tab-pane" id="photo">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="card m-b-30">
                                            <div class="card-body">

                                                <div id="user-activities" class="tab-pane">
                                                    <div class="timeline-2">
                                                        <div class="time-item">
                                                            <div class="item-info">
                                                                <div id="time_line">

                                                                    <hr>

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover m-b-0">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Action</th>
                                                                                            <th>Description</th>
                                                                                            <th>Performed At</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($user->timelines as $timeline)
                                                                                            <tr>
                                                                                                <td>{{ $loop->iteration }}
                                                                                                </td>
                                                                                                <td>{{ explode('\\', $timeline->subject_type)[2] }}
                                                                                                </td>
                                                                                                <td>{{ $timeline->description }}
                                                                                                </td>
                                                                                                <td>{{ $timeline->created_at }}
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
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>

                            <!-- =================SETTINGS============= -->

                            <div class="tab-pane" id="settings">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="card m-b-30">
                                            <div class="card-body">



                                                <div id="assigned_task">
                                                    <div class="row mt-5">
                                                        <div class="col-md-6">
                                                            <h5 class="header-title pb-3">Assigned Tasks</h5>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Job#</th>
                                                                            <th>Task Type</th>
                                                                            <th>Department</th>
                                                                            <th>Applied Date</th>
                                                                            <th>Status</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($user->assignTaksIds as $item)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ optional($item->task)->id }}</td>
                                                                                <td>{{ optional(optional($item->task)->taskCategory)->name }}
                                                                                </td>
                                                                                <td>{{ optional(optional($item->task)->department)->name }}
                                                                                </td>
                                                                                <td>{{ optional($item->task)->date }}</td>
                                                                                <td>
                                                                                    @if (optional($item->task)->status == App\Models\Task::PENDING)
                                                                                        <span
                                                                                            class="badge badge-danger">PENDING</span>
                                                                                    @elseif(optional($item->task)->status == App\Models\Task::INPROGRESS)
                                                                                        <span
                                                                                            class="badge badge-primary">INPROGRESS</span>
                                                                                    @elseif(optional($item->task)->status == App\Models\Task::COMPLETED)
                                                                                        <span
                                                                                            class=""badge badge-danger">COMPLETED</span>
                                                                                    @elseif(optional($item->task)->status == App\Models\Task::CANCELED)
                                                                                        <span
                                                                                            class="badge badge-danger">CANCELED</span>
                                                                                    @elseif(optional($item->task)->status == App\Models\Task::APPROVED)
                                                                                        <span
                                                                                            class="badge badge-info">APPROVED</span>
                                                                                    @endif

                                                                                </td>
                                                                                <td>
                                                                                    <a target="_blank"
                                                                                        class="btn save-btn btn-sm"
                                                                                        href="{{ route('tasks.show', optional($item->task)->id) }}"><i
                                                                                            class="fa fa-eye"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>

















                <div class="col-lg-9 col-sm-12">



                </div>
            </div><!--end row-->

        </div><!--end container-->




        <!-- ========================================================================== -->


    </div>
@endsection
