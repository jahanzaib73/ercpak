@extends('layouts.app')
@section('protocol-liaison-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Contacts</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Contact Numbers Listing</h5>
                            </div>
                            @if (Auth::user()->can('Add Protocol and Liaison Contact'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('protocol-liaison-contact-numbers.create', ['id' => $protocolLiaisonId]) }}"
                                        class="btn save-btn mr-3 btn-sm">Add New Number</a>
                                </div>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Contact Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contacts as $team)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>{{ ucfirst($team->contact_numebr) }}</td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Protocol and Liaison Contact'))
                                                            <a class="btn bg-info btn-sm edit text-white"
                                                                href="{{ route('protocol-liaison-teams.edit', ['id' => $team->id, 'protocol_liaison_id' => $protocolLiaisonId]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Protocol and Liaison Contact'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('protocol-liaison-teams.delete', ['id' => $team->id, 'protocol_liaison_id' => $protocolLiaisonId]) }}"><i
                                                                    class="fa fa-trash-o"></i></a>
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
    </div>
@endsection
