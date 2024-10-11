@extends('layouts.app')
@section('remainder-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Update Reminder</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('remainders.update', ['id' => $remainder->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div id="by_air_container">
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Reminder Detail</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Title</label> --}}
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', $remainder->title) }}" placeholder="Title" />
                                            @error('title')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Select Reminder Type</label> --}}
                                            <select name="remainder_type_id" id="remainder_type_id" class="form-control">
                                                <option value="">Select Reminder Type</option>
                                                @foreach ($remainderTypes as $type)
                                                    <option
                                                        {{ old('remainder_type_id', $remainder->remainder_type_id) == $type->id ? 'selected' : '' }}
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Select Employee</label> --}}
                                            <select multiple name="employee_id[]" id="employee_id" class="form-control">
                                                <option value="">Select Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option
                                                        {{ in_array($employee->id, old('employee_id') ?: getRemainderEployesIds($remainder->id)) ? 'selected' : '' }}
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

                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Select Issuing Authority</label> --}}
                                            <select name="issuing_authority_id" id="issuing_authority_id"
                                                class="form-control">
                                                <option value="">Select Issuing Authority</option>
                                                @foreach ($issuingAuthority as $authority)
                                                    <option
                                                        {{ old('issuing_authority_id', $remainder->issuing_authority_id) == $authority->id ? 'selected' : '' }}
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Expiray Date</label> --}}
                                            <input type="checkbox" class="form-control p-2 pb-3" value="1"
                                                name="is_expairy_date" id="is_expairy_date"
                                                {{ old('is_expairy_date', $remainder->is_expairy_date) == 1 ? 'checked' : '' }}>
                                            @error('is_expairy_date')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 expiary_date_container {{ old('is_expairy_date', $remainder->is_expairy_date) == 1 ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            {{-- <label>Select Expairy Date</label> --}}
                                            <input type="datetime-local" class="form-control" name="expairy_date"
                                                id="expairy_date"
                                                value="{{ old('expairy_date', $remainder->expairy_date) }}">
                                            @error('expairy_date')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Reminder Detail</label>
                                    <textarea name="detail" placeholder="Remainder Detail" id="detail" cols="30" rows="2"
                                        class="form-control">{{ old('detail', $remainder->detail) }}</textarea>
                                    @error('detail')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group mb-0 d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn save-btn">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                <hr>
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
