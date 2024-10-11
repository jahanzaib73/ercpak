@extends('layouts.app')
@section('remainder-active-class', 'active')
@section('content')
    <div class="container">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Create Reminder</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('remainders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <h4 class="bg-danger text-center rounded text-white py-2">Reminder Detail</h4>
                        <div class="card-body">
                            <div id="by_air_container">
                              

                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label><strong>Title</strong></label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') }}" placeholder="Title" />
                                            @error('title')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label><strong>Select Reminder Type</strong></label>
                                            <select name="remainder_type_id" id="remainder_type_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($remainderTypes as $type)
                                                    <option {{ old('remainder_type_id') == $type->id ? 'selected' : '' }}
                                                        value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('remainder_type_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label><strong>Select Employee</strong></label>
                                            <select multiple name="employee_id[]" id="employee_id" class="form-control">
                                            <option value="">Please Select</option>
                                                @foreach ($employees as $employee)
                                                    <option
                                                        {{ in_array($employee->id, old('employee_id') ?: []) ? 'selected' : '' }}
                                                        value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label><strong>Select Issuing Authority</strong></label>
                                            <select name="issuing_authority_id" id="issuing_authority_id"
                                                class="form-control">
                                                @foreach ($issuingAuthority as $authority)
                                                    <option
                                                        {{ old('issuing_authority_id') == $authority->id ? 'selected' : '' }}
                                                        value="{{ $authority->id }}">
                                                        {{ $authority->name_of_issuing_authorities }}</option>
                                                @endforeach
                                            </select>
                                            @error('issuing_authority_id')
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
                                            <label><strong>Date Time</strong></label>
                                            <input type="datetime-local" name="date_time" class="form-control"
                                                value="{{ old('date_time', date("Y-m-d H:i:s")) }}" />
                                            @error('date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>Expiray Date</strong></label>
                                            <input style="border: none !important" type="checkbox" class="form-control p-2 mt-1" value="1"
                                                name="is_expairy_date" id="is_expairy_date"
                                                {{ old('is_expairy_date') == 1 ? 'checked' : '' }}>
                                            @error('is_expairy_date')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 expiary_date_container {{ old('is_expairy_date') == 1 ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            <label><strong>Select Expairy Date</strong></label>
                                            <input type="datetime-local" class="form-control" name="expairy_date"
                                                id="expairy_date" value="{{ old('expairy_date', date("Y-m-d H:i:s")) }}">
                                            @error('expairy_date')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 pl-0">
                                    <label><strong>Reminder Detail</strong></label>
                                    <textarea name="detail" placeholder="Reminder Detail" id="detail" rows="2"
                                        class="form-control">{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             
                                <div class="form-group mb-0 ">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn save-btn px-3">
                                            Save
                                        </button>
                                    </div>
                                </div>
                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#is_expairy_date').change(function() {
                if (this.checked) {
                    $('.expiary_date_container').removeClass('d-none');
                } else {

                    $('.expiary_date_container').addClass('d-none');
                }

            });
        });
    </script>
@endsection
