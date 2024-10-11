{{--  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://db.onlinewebfonts.com/c/02f502e5eefeb353e5f83fc5045348dc?family=GE+SS+Two+Light" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f186debb04.js" crossorigin="anonymous"></script>
    <title>Projects</title>
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

        html body .print-tab {
            background: rgb(255, 255, 255);

        }



        .title-page {
            width: 100vh;
            height: 120vh;
            position: relative;
            background-image: url("{{ asset('img/ERC_Report.png') }}");
            background-size: cover;
        }

        .overlay {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 170px;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }

        @media print {
            page {
                size: A4;
                background: white;
                width: max-content;
                margin: 0 auto;
                margin-bottom: 0.5cm;


            }

        }

        /* @page {
  size: A4;
  margin: 0;
  padding: 0;
} */
    </style>
</head>

<body>

    <div class="nprint-tab page">

        <section class="container">
            <div class="tab-pane fade show" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                <div class="d-flex justify-content-between">
                    <h4>Report</h4>

                </div>
                <div class="print-tab page">
                    <page size="A4">

                        <div class="row m-0 p-0 align-items-center justify-content-between print-tab page">
                            <div class="title-page">
                                <div>
                                    <a onclick="window.print();" class="btn btn-secondary">Print</a>
                                </div>
                                <div class="overlay">
                                    <table class="table table-bordered w-50">

                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <p class="arabic red">المشاريع المهمة #</p>
                                                    <p>Project & Task #</p>
                                                </th>
                                                <td>{{ optional($task->project)->id }} / {{ $task->id }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <p class="arabic red">اسم المشروع</p>
                                                    <p>Project Name</p>
                                                </th>
                                                <td>{{ optional($task->project)->project_name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <p class="arabic red">موقع</p>
                                                    <p>Location</p>
                                                </th>
                                                <td>{{ optional($task->location)->name }}</td>
                                            </tr>
                                        </tbody>


                                    </table>

                                </div>
                            </div>

                        </div>

                    </page>
                </div>
                <div class="print-tab page">
                    <page size="A4">
                        <div class="px-5 py-0">
                            <div class="m-0 p-0">
                                <img src="{{ asset('img/ERC-Header.png') }}" alt="" width="100%">
                            </div>
                            <div class="text-center">
                                <h4>Project Name Here</h4>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Project #</th>
                                        <th scope="col">Task #</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ optional($task->project)->id }}</th>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ optional($task->location)->name }}</td>
                                    </tr>

                                </tbody>
                            </table>


                            <div>
                                <div id="reportTaskMap"
                                    style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                                </div>
                            </div>
                            <div class="text-center pt-3">
                                <h5>Project Images</h5>
                            </div>
                            <div>
                                <img src="{{ optional($task->project)->featured_image_url }}" alt=""
                                    width="100%" height="250px">
                            </div>
                            <hr>
                            <div class="row pt-2">
                                @if (optional($task->project)->attachments)
                                    @foreach ($task->project->attachments as $attachment)
                                        <div class="col-2">
                                            <img src="{{ $attachment->file_url }}" alt="" width="100%">
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <hr>
                        <div class="p-0 m-0 pt-2">
                            <img src="{{ asset('img/ERC-Footer.png') }}" alt="" width="100%">
                        </div>
                    </page>

                </div>

            </div>

        </section>
    </div>


    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script>
        var reportTaskMap = new google.maps.Map(document.getElementById('reportTaskMap'), {
            center: {
                lat: 31.561560648568946,
                lng: 74.31137413872314
            },
            zoom: 5,
        });


        // Loop through tasks and add a marker for each task
        if (task.latitude !== undefined && task.longitude !== undefined && !isNaN(task.latitude) && !isNaN(task
                .longitude)) {
            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(task.latitude),
                    lng: parseFloat(task.longitude)
                },
                map: reportTaskMap,
                title: 'Task Marker',
            });
        } else {
            console.error('Invalid lat/lng values for a task:', task);
        }
    </script>


</body>

</html>  --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://db.onlinewebfonts.com/c/02f502e5eefeb353e5f83fc5045348dc?family=GE+SS+Two+Light" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f186debb04.js" crossorigin="anonymous"></script>
    <title>Projects</title>
    <style>
        @font-face {
            font-family: "GE SS Two Light";
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot");
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot?#iefix") format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff2") format("woff2"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff") format("woff"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.ttf") format("truetype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.svg#GE SS Two Light") format("svg");
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

        .print-tab.page {
            background: rgb(255, 255, 255);
        }

        .title-page {
            width: 100vh;
            height: 120vh;
            position: relative;
            background-image: url("{{ asset('img/ERC_Report.png') }}");
            background-size: cover;
        }

        .overlay {
            width: 100%;
            height: 95%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 170px;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        @media print {

            .print-tab.page {
                background-color: #fff;
                /* Set a background color for print */
            }

            .title-page {
                width: 100% !important;
                height: 85vh;
                position: cover;
                background-image: url("{{ asset('img/ERC_Report.png') }}");
                background-size: cover;
            }

            .overlay {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                margin-top: 200px;
            }

            /* Hide elements not relevant for print */
            .no-print {
                display: none;
            }

            .secondPage {
                margin-top: 1000px !important;
            }

            .modal {
                display: none !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 20px;
                text-align: left;
            }

            .no-print {
                display: none;
            }
        }

        /* Custom Styles */
        .custom-row {
            display: flex;
            flex-wrap: wrap;
            margin-top: 2px;
        }

        .custom-col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
            margin-bottom: 15px;
        }

        .custom-img-fluid {
            max-width: 100%;
            height: auto;
        }

        .custom-img-thumbnail {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 4px;
        }
    </style>
</head>

<body>

    <section class="">
        <div class="print-tab page">
            <page size="A4">

                <div class="row m-0 p-0 align-items-center justify-content-between print-tab page">
                    <div class="title-page">
                        <div class="no-print">
                            <a onclick="window.print();" class="btn btn-secondary">Print</a>
                        </div>
                        <div class="overlay">
                            <table class="table table-bordered w-50">

                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <p class="arabic red">المشاريع المهمة #</p>
                                            <p>Project & Task #</p>
                                        </th>
                                        <td>{{ optional($task->project)->id }} / {{ $task->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <p class="arabic red">اسم المشروع</p>
                                            <p>Project Name</p>
                                        </th>
                                        <td>{{ optional($task->project)->project_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <p class="arabic red">موقع</p>
                                            <p>Location</p>
                                        </th>
                                        <td>{{ optional($task->location)->name }}</td>
                                    </tr>
                                </tbody>


                            </table>

                        </div>
                    </div>

                </div>

            </page>
        </div>
        <div class="print-tab page secondPage">
            <page size="A4">
                <div class="px-5 py-0">
                    <div class="m-0 p-0">
                        <img src="{{ asset('img/ERC-Header.png') }}" alt="" width="100%">
                    </div>
                    <div class="text-center">
                        <h4>{{ optional($task->project)->project_name }}</h4>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Project #</th>
                                <th scope="col">Task #</th>
                                <th scope="col">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ optional($task->project)->id }}</th>
                                <td>{{ $task->id }}</td>
                                <td>{{ optional($task->location)->name }}</td>
                            </tr>

                        </tbody>
                    </table>


                    <div>
                        <div id="reportTaskMap"
                            style="position: relative; overflow: hidden; height: 300px; width: 100%;">
                        </div>
                    </div>
                    <div class="text-center pt-3">
                        <h5>Project Images</h5>
                    </div>
                    <div>
                        <img src="{{ $task->featured_image_url }}" alt="" width="100%" height="250px">
                    </div>
                    <hr>
                    <div class="custom-row pt-2">
                        @if ($task->attachments)

                            @foreach ($task->attachments()->limit(2)->get() as $attachment)
                                <div class="custom-col-md-3 mb-3">
                                    @if (is_image($attachment->file_url))
                                        <img src="{{ asset($attachment->file_url) }}" style="width: 50%"
                                            class="custom-img-fluid custom-img-thumbnail" alt="Image"
                                            data-toggle="modal" data-target="#imageModal{{ $loop->index }}">
                                    @else
                                        <a href="#" data-toggle="modal"
                                            data-target="#fileModal{{ $loop->index }}">
                                            <img src="{{ asset(get_file_icon($attachment->file_url)) }}"
                                                style="width: 50%" class="custom-img-fluid custom-img-thumbnail"
                                                alt="File Icon">
                                        </a>
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
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                @if (is_image($attachment->file_url))
                                                    <img src="{{ asset($attachment->file_url) }}" class="img-fluid"
                                                        alt="Image">
                                                @else
                                                    <p>This is a non-image file.</p>
                                                    <a href="{{ asset($attachment->file_url) }}"
                                                        class="btn btn-primary" download>
                                                        Download
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="col-2">
                                            <img src="{{ $attachment->file_url }}" alt="" width="100%">
                                        </div>  --}}
                            @endforeach
                        @endif

                    </div>
                </div>
                <hr>
                <div class="p-0 m-0 pt-2">
                    <img src="{{ asset('img/ERC-Footer.png') }}" alt="" width="100%">
                </div>
            </page>

        </div>
    </section>

    <!-- Add the rest of your JavaScript includes and scripts here -->
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script>
        var task = JSON.parse('{!! addslashes(json_encode($task)) !!}');
        var reportTaskMap = new google.maps.Map(document.getElementById('reportTaskMap'), {
            center: {
                lat: 31.561560648568946,
                lng: 74.31137413872314
            },
            zoom: 5,
        });


        // Loop through tasks and add a marker for each task
        if (task.latitude !== undefined && task.longitude !== undefined && !isNaN(task.latitude) && !isNaN(task
                .longitude)) {
            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(task.latitude),
                    lng: parseFloat(task.longitude)
                },
                map: reportTaskMap,
                title: 'Task Marker',
            });
        } else {
            console.error('Invalid lat/lng values for a task:', task);
        }
    </script>
</body>

</html>
