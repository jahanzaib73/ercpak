@extends('layouts.app')
@section('erc-active-class', 'active')
@section('css')
    {{--  <link href="https://db.onlinewebfonts.com/c/02f502e5eefeb353e5f83fc5045348dc?family=GE+SS+Two+Light" rel="stylesheet">  --}}
    <style>
        @font-face {
            font-family: "GE SS Two Light";
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot");
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot?#iefix")format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff2")format("woff2"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff")format("woff"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.ttf")format("truetype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.svg#GE SS Two Light")format("svg");
        }

        .arabic {
            font-family: "GE SS Two Light";
        }

        .red {
            color: red;
        }

        p {
            margin-block: 0;
        }

        #map {
            height: 400px;
        }

        body>section>div.body-content>div.container-fluid.mt-5>section:nth-child(4)>div.d-flex.justify-content-between.pb-1>div>h5>span {
            margin-left: 10px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Team Members</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">

            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Team Members List</h5>
                            </div>
                            <div class="col-md-6">
                                @if (Auth::user()->can('Add Member'))
                                    <button type="button" data-toggle="modal" data-target="#memberModal"
                                        class="btn save-btn mr-3 m-b-10 pull-right">Add
                                        Team Member</button>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Team</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teamMembers as $member)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($member->user)->full_name }}</td>
                                                    <td><img src="{{ $member->photo_url }}" alt="{{ $member->member_name }}"
                                                            width="50"></td>
                                                    <td>{{ $member->member_name }}</td>
                                                    <td>{{ optional($member->team)->team_name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $member->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $member->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td class="text-center">
                                                        @if (Auth::user()->can('Edit Member'))
                                                            <button class="btn save-btn btn-sm team_member_edit_button"
                                                                data-id="{{ $member->id }}"
                                                                data-member_name="{{ $member->member_name }}"
                                                                data-member_city="{{ $member->team_id }}"
                                                                data-member_status="{{ $member->status }}"
                                                                type="button"><i class="fa fa-edit"></i></button>
                                                        @endif

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
        @include('admin.erc._models._add_team_member')
        @include('admin.erc._models._edit_team_member')
    </div>
@endsection
@section('script')
    <script>
        const teamMemberUrl = "{{ route('team.members.store') }}";
    </script>

    <script src="{{ asset('team_management/TeamMember.js') }}"></script>
@endsection
