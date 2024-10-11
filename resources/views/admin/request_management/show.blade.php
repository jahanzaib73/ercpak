@extends('layouts.app')
@section('request-management-active-class', 'active')

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

        /* Default color for tab text */
        .nav-tabs .nav-link {
            color: red;
        }

        /* Active tab color */
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: white !important;

            /* Optionally, you can set a border color for the active tab */
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <section class="container">
            <hr>

            <!-- =========================== -->

            <section class="container">
                <div class="text-center d-flex justify-content-between">
                    <h1>{{ optional($request->requestType)->name }}</h1>
                    <h1 class="arabic red">نوع الطلب</h1>
                </div>
                <hr>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-md-4">
                        <img src="{{ $request->featured_image_url ? asset($request->featured_image_url) : asset('img/1-2.jpg') }}"
                            class="card-img-top" alt="..." width="100%">
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-0">Request #: </h6>
                            <h6>{{ $request->id }} / {{ $request->request_date }}</h6>
                            <h6 class="arabic">رقم الطلب</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text mt-0">{{ $request->requestee_name }}</p>
                            {{--  <p class="card-text mt-0 arabic">مركز الشيخ زايد</p>  --}}
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="mt-0">Age & Gender :</p>
                            <p class="mt-0"><strong>{{ $request->age }} / {{ $request->gender }}</strong></p>
                            <p class="mt-0 arabic"> : العمر والجنس</p>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-between">
                            <p class="mt-0">City Name :</p>
                            <p class="mt-0"><strong>{{ optional($request->city)->name }}</strong></p>
                            <p class="mt-0 arabic"> : اسم المدينة</p>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-between">
                            <p class="mt-0">Province :</p>
                            <p class="mt-0"><strong>{{ optional($request->province)->name }}</strong></p>
                            <p class="mt-0 arabic"> : مقاطعة</p>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-between">
                            <p class="mt-0">Country :</p>
                            <p class="mt-0"><strong>{{ optional($request->country)->name }}</strong></p>
                            <p class="mt-0 arabic"> : دولة</p>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-between">
                            <p class="mt-0">Contact :</p>
                            <p class="mt-0"><strong>{{ $request->contact }}</strong></p>
                            <p class="mt-0 arabic"> : اتصال</p>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-between">
                            <p class="mt-0">Email :</p>
                            <p class="mt-0"><strong>{{ $request->email }}</strong></p>
                            <p class="mt-0 arabic"> : بريد إلكتروني</p>
                        </div>


                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex justify-content-between px-2 pb-2">
                            <div>
                                <p>Status</p>
                            </div>
                            <div>
                                <p class="arabic red"> حالة</p>
                            </div>

                        </div>
                        @if ($request->status == 0)
                            <div class="progress" style="height: 38px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Waiting to Start</div>
                            </div>
                        @elseif($request->status == 1)
                            <div class="progress" style="height: 38px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">INPROGRESS</div>
                            </div>
                        @elseif($request->status == 2)
                            <div class="progress" style="height: 38px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><i
                                        class="fa fa-thumbs-up"></i></div>
                            </div>
                        @endif

                    </div>
                </div>
                <hr>
                <div class="row ">
                    <div class="col-12 col-md-6 w-100">
                        <h4>Description of Request</h4>
                        <p>{{ $request->notes }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4 class="arabic red text-right">وصف الطلب</h4>
                        <p class="arabic text-right">{{ $request->notesarabic }}</p>
                    </div>
                </div>
            </section>
            <!-- ==============================        -->
            <hr>
            <div class="d-flex justify-content-between">
                <h3>Attachments and Photos</h3>
                <h3 class="arabic red">المرفقات والصور</h3>
            </div>
            <hr>
            <div class="row pb-5">
                {{--  @foreach ($request->attachments as $attachment)
                    <div class="col-12 col-md-4">
                        @if (in_array($attachment->file_type, ['png', 'jpg', 'jpeg', 'gif']))
                            <img src="{{ asset($attachment->file_url) }}" width="150" alt="..."><br>
                        @elseif($attachment->file_type == 'doc')
                            <img src="{{ asset('icons/doc.webp') }}" width="150" alt="Document Icon"><br>
                        @elseif($attachment->file_type == 'pdf')
                            <img src="{{ asset('icons/pdf.png') }}" width="150" alt="PDF Icon"><br>
                        @elseif($attachment->file_type == 'xlsx')
                            <img src="{{ asset('icons/xls.png') }}" width="150" alt="PDF Icon"><br>
                        @else
                            <!-- Default case, you can handle other file types similarly -->
                            <img src="{{ asset('img/pic.png') }}" width="150" alt="Default Icon"><br>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $attachment->title }}</h5>
                            <h5 class="arabic red">{{ $attachment->arabic_title }}</h5>
                        </div>

                        <p class="pb-3">{{ $attachment->description }}</p>

                        @if (!in_array($attachment->file_type, ['png', 'jpg', 'jpeg', 'gif']))
                            <a href="{{ asset($attachment->file_path) }}" download>Download</a>
                        @endif
                    </div>
                @endforeach  --}}


                @if ($request->attachments)

                    @foreach ($request->attachments as $attachment)
                        <div class="col-12 col-md-4">
                            @if (is_image($attachment->file_url))
                                <img src="{{ asset($attachment->file_url) }}" width="150" alt="Image"
                                    data-toggle="modal" data-target="#imageModal{{ $loop->index }}">
                            @else
                                <a href="#" data-toggle="modal" data-target="#fileModal{{ $loop->index }}">
                                    <img src="{{ asset(get_file_icon($attachment->file_url)) }}" width="150"
                                        alt="File Icon">
                                </a>
                            @endif

                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $attachment->title }}</h5>
                                <h5 class="arabic red">{{ $attachment->arabic_title }}</h5>
                            </div>

                            <p class="pb-3">{{ $attachment->description }}</p>

                            @if (!in_array($attachment->file_type, ['png', 'jpg', 'jpeg', 'gif']))
                                <a href="{{ asset($attachment->file_path) }}">Download</a>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div class="modal fade"
                            id="{{ is_image($attachment->file_url) ? 'imageModal' : 'fileModal' }}{{ $loop->index }}"
                            tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $loop->index }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $loop->index }}">
                                            {{ is_image($attachment->file_url) ? 'Image' : 'File' }}
                                            Popup</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if (is_image($attachment->file_url))
                                            <div class="card">
                                                <img src="{{ asset($attachment->file_url) }}" class="card-img-top"
                                                    alt="Image" style="object-fit: cover;">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">{{ $attachment->title }}</h5>
                                                    </div>
                                                    <p class="pb-3">{{ $attachment->description }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>This is a non-image file.</p>
                                                    <a href="{{ asset($attachment->file_url) }}" class="btn btn-primary"
                                                        download>
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </section>

    </div>
@endsection
@section('script')
@endsection
