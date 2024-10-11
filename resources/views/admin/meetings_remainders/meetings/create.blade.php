@extends('layouts.app')
@section('meeting-active-class', 'active')
@section('content')
    <div class="container">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('meetings.index') }}">Meeting Listing</a> / Create Meeting</h4>
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
                                <h5 class="header-title pb-3">Create Meeting</h5>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <form class="" method="post" action="{{ route('meetings.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label><strong>Meeting Title</strong></label>
                                                <input type="text" placeholder="Meeting Title" name="meeting_title"
                                                    class="form-control" value="{{ old('meeting_title') }}" />
                                                @error('meeting_title')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label><strong>Meeting Location</strong></label>
                                                <select name="meeting_location" id="meeting_location" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach ($locations as $location)
                                                        <option
                                                            {{ old('meeting_location') == $location->id ? 'selected' : '' }}
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
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label><strong>Meeting Date Time</strong></label>
                                                <input type="datetime-local" name="meeting_date_time" class="form-control"
                                                    value="{{ old('meeting_date_time') }}" />
                                                @error('meeting_date_time')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                     

                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label><strong>Meeting End Date Time</strong></label>
                                                <input type="datetime-local" name="meeting_end_date_time"
                                                    class="form-control" value="{{ old('meeting_end_date_time') }}" />
                                                @error('meeting_end_date_time')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5 col-lg-4">

                                            <div class="form-group">
                                                <label><strong>Host</strong></label>
                                                <select multiple name="host[]" id="host" class="form-control">

                                                    @foreach ($hostParticipents as $host)
                                                        <option
                                                            value="{{ $host->id . ':' . optional($host->protocolLiaisonType)->name }}"
                                                            {{ in_array($host->id, old('host') ?: []) ? 'selected' : '' }}>
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
                                        <div class="col-12 col-md-5 col-lg-4">

                                            <div class="form-group">
                                                <label><strong>Participant</strong></label>
                                                <select multiple name="participant[]" id="participant" class="form-control">
                                                    @foreach ($hostParticipents as $participant)
                                                        @dump($participant->id, old('participant') ?: [])
                                                        <option
                                                            value="{{ $participant->id . ':' . optional($participant->protocolLiaisonType)->name }}"
                                                            {{ in_array($participant->id, old('participant') ?: []) ? 'selected' : '' }}>
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


                                    <div class="form-group col-12 px-0 ">
                                        <label><strong>Meeting Detail</strong></label>
                                        <textarea name="meeting_detail" placeholder="Specific Detail of Meeting" id="meeting_detail" rows="3"
                                            class="form-control">{{ old('meeting_detail') }}</textarea>
                                        @error('meeting_detail')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0 ">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn save-btn px-3">
                                                Save
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
