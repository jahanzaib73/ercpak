@extends('layouts.app')
@section('meeting-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('meetings.index') }}">Meeting Listing</a> / Meeting Detail</h4>
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
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Meting Detail</h5>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Meeting Start Title</label>
                                            <h6>{{ $meeting->meeting_title }}</h6>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Meeting Date Time</label>
                                            <h6>{{ $meeting->meeting_date_time }}</h6>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Meeting End Date Time</label>
                                            <h6>{{ $meeting->meeting_end_date_time }}</h6>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Meeting Location</label>
                                            <h6>{{ $meeting->meeting_location }}</h6>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Meeting Detail</label>
                                    <textarea name="meeting_detail" placeholder="Specific Detail of Meeting" id="meeting_detail" cols="30"
                                        rows="2" class="form-control">{{ old('meeting_detail', $meeting->meeting_detail) }}</textarea>
                                    @error('meeting_detail')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <hr>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Host Lists</h5>
                                    </div>
                                </div>
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Host Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($meeting->hosts)
                                            @foreach ($meeting->hosts as $host)
                                                <tr>
                                                    <td><img src="{{ asset('uploads' . '/' . $item->image) }}"
                                                        alt="data" width="50px" height="50px"></td>
                                                   
                                                    <td>{{ $host->official_notable_type }}</td>
                                                    <td>{{ optional($host->officialNotable)->official_name ? optional($host->officialNotable)->official_name : optional($host->officialNotable)->notable_name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <hr>

                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Participant Lists</h5>
                                    </div>
                                </div>
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Participant Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($meeting->participants)
                                            @foreach ($meeting->participants as $participant)
                                                {{--  @dump($participant)  --}}
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $participant->official_notable_type }}</td>
                                                    @if ($participant->official_notable_type == 'Notable')
                                                        <td>{{ optional($participant->officialNotable)->notable_name }}
                                                        </td>
                                                    @elseif($participant->official_notable_type == 'Official')
                                                        <td>{{ optional($participant->officialNotable)->official_name }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
