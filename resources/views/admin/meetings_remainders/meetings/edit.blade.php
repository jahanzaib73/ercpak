@extends('layouts.app')
@section('meeting-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('meetings.index') }}">Meeting Listing</a> / Update Meeting</h4>
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
                                <h5 class="header-title pb-3">Update Meeting</h5>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <form class="" method="post"
                                    action="{{ route('meetings.update', ['id' => $meeting->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{-- <label>Meeting Title</label> --}}
                                                <input type="text" placeholder="Meeting Title" name="meeting_title"
                                                    class="form-control"
                                                    value="{{ old('meeting_title', $meeting->meeting_title) }}" />
                                                @error('meeting_title')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{-- <label>Meeting Location</label> --}}
                                                <select name="meeting_location" id="meeting_location" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach ($locations as $location)
                                                        <option
                                                            {{ $meeting->meeting_location == $location->id ? 'selected' : '' }}
                                                            value="{{ $location->id }}">
                                                            {{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('meeting_location')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{-- <label>Meeting Date Time</label> --}}
                                                <input type="datetime-local" name="meeting_date_time" class="form-control"
                                                    value="{{ old('meeting_date_time', $meeting->meeting_date_time) }}" />
                                                @error('meeting_date_time')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{-- <label>Meeting End Date Time</label> --}}
                                                <input type="datetime-local" name="meeting_end_date_time"
                                                    class="form-control"
                                                    value="{{ old('meeting_end_date_time', $meeting->meeting_end_date_time) }}" />
                                                @error('meeting_end_date_time')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{-- <label>Host</label> --}}
                                                <select multiple name="host[]" id="host" class="form-control">

                                                    @foreach ($hostParticipents as $host)
                                                        <option
                                                            value="{{ $host->id . ':' . optional($host->protocolLiaisonType)->name }}"
                                                            {{ in_array($host->id, old('host') ?: $meeting->host_ids->toArray()) ? 'selected' : '' }}>
                                                            @if ($host->official_name)
                                                                {{ $host->official_name . ' (' . optional($host->protocolLiaisonType)->name . ')' }}
                                                            @elseif ($host->notable_name)
                                                                {{ $host->notable_name . ' (' . optional($host->protocolLiaisonType)->name . ')' }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('host')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{-- <label>Participant</label> --}}
                                                <select multiple name="participant[]" id="participant" class="form-control">
                                                    @foreach ($hostParticipents as $participant)
                                                        @dump($participant->id, old('participant') ?: [])
                                                        <option
                                                            value="{{ $participant->id . ':' . optional($participant->protocolLiaisonType)->name }}"
                                                            {{ in_array($participant->id, old('participant') ?: $meeting->participant_ids->toArray()) ? 'selected' : '' }}>
                                                            @if ($participant->official_name)
                                                                {{ $participant->official_name . ' (' . optional($participant->protocolLiaisonType)->name . ')' }}
                                                            @elseif ($participant->notable_name)
                                                                {{ $participant->notable_name . ' (' . optional($participant->protocolLiaisonType)->name . ')' }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('participant')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        
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

                                    <div class="form-group mb-0 d-flex justify-content-end">
                                        <div>
                                            <button type="submit" class="btn save-btn">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
