<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Theme icon -->
    {{-- <link rel="shortcut icon" href="{{ asset('favicon.png') }}"> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <!--fullcalendar-->
    <link href="{{ asset('assets/plugins/fullcalendar2/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/plugins/morris-chart/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">

    <!-- Theme Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slidebars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/cropper.min.css') }}" rel="stylesheet" type="text/css">
    @php
        $layoutSettings = App\Models\LayoutSettings::where('user_id', Auth::id())->first();
        $response = null;
        if ($layoutSettings) {
            $response = json_decode($layoutSettings->settings);
        }
    @endphp
    @if ($response && $response->settings == '2')
        <link id="css-link" href="{{ asset('assets/css/style-secondary.css') }}" rel="stylesheet">
    @else
        <link id="css-link" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @endif

    <link href="{{ asset('assets/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('croppie/croppie.css') }}" rel="stylesheet">
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('print-styles.css') }}" media="print">  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{ asset('assets/plugins/notifications/notification.css') }}" rel="stylesheet" />

    <style>
        .map {
            height: 400px;
            width: 100%;
        }

        #main_map>div>div>div:nth-child(2)>div:nth-child(2)>div>div:nth-child(4)>div>div>div>div.gm-style-iw.gm-style-iw-c>div>div {
            padding: 10px !important;
            line-height: 22px !important;
        }

        .gm-style-iw-d {
            max-height: 500px !important;
        }

        .gm-style-iw {
            max-height: 251px !important;
        }

        .form-control-sm {
            border: 1px solid #a80000 !important;
        }

        textarea {
            border: 1px solid #a80000 !important;
        }


        a.bg-info:hover {
            background-color: #707070 !important;
        }

        a.bg-info:focus {
            background-color: #731010 !important;

        }

        .right-notification .notification-menu>li>a>img {
            width: 29px;
            height: 29px;
            border-radius: 50%;
            border: 1px solid white !important;
        }



        @media print {
            .bimagec {
                margin-top: 120px !important;
            }

            /* Add any other print-specific styles here */
        }

        .select2 {
            width: 100% !important;
        }
    </style>
    @yield('css')
</head>

<body class="sticky-header">
    <section>
        <!-- sidebar left start-->
        @include('layouts.partials/sidebar')
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content">
            <!-- header section start-->
            @include('layouts.partials/header')
            <!-- header section end-->

            @yield('content')

            <!--end container-->

            <!--footer section start-->
            @include('layouts.partials/footor')
            <!--footer section end-->


            <!-- Right Slidebar start -->
            <div class="sb-slidebar sb-right sb-style-overlay">
                <div class="right-bar slimscroll">
                    <span class="r-close-btn sb-close"><i class="fa fa-times"></i></span>

                    <ul class="nav nav-tabs nav-justified-">
                        <li class="">
                            <a href="#chat" class="active" data-toggle="tab">Chat</a>
                        </li>
                        <li class="">
                            <a href="#activity" data-toggle="tab">Activity</a>
                        </li>
                        <li class="">
                            <a href="#settings" data-toggle="tab">Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="chat">
                            <div class="online-chat">
                                <div class="online-chat-container">
                                    <div class="chat-list">
                                        <form class="search-content" action="index.html" method="post">
                                            <input type="text" class="form-control" name="keyword"
                                                placeholder="Search...">
                                            <span class="search-button"><i class="ti ti-search"></i></span>
                                        </form>
                                    </div>
                                    <div class="side-title-alt">
                                        <h2>online</h2>
                                    </div>

                                    <ul class="team-list chat-list-side">
                                        <li>
                                            <a href="#" class="ml-3">
                                                <span class="thumb-small">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                        alt="">
                                                    <i class="online dot"></i>
                                                </span>
                                                <div class="inline">
                                                    <span class="name">Alison Jones</span>
                                                    <small class="text-muted">Start exploring</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="ml-3">
                                                <span class="thumb-small">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                        alt="">
                                                    <i class="online dot"></i>
                                                </span>
                                                <div class="inline">
                                                    <span class="name">Jonathan Smith</span>
                                                    <small class="text-muted">Alien Inside</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="ml-3">
                                                <span class="thumb-small">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                                        alt="">
                                                    <i class="away dot"></i>
                                                </span>
                                                <div class="inline">
                                                    <span class="name">Anjelina Doe</span>
                                                    <small class="text-muted">Screaming...</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="ml-3">
                                                <span class="thumb-small">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                                        alt="">
                                                    <i class="busy dot"></i>
                                                </span>
                                                <div class="inline">
                                                    <span class="name">Franklin Adam</span>
                                                    <small class="text-muted">Dont lose the hope</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="ml-3">
                                                <span class="thumb-small">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/images/users/avatar-6.jpg') }}"
                                                        alt="">
                                                    <i class="online dot"></i>
                                                </span>
                                                <div class="inline">
                                                    <span class="name">Jeff Crowford </span>
                                                    <small class="text-muted">Just flying</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="side-title-alt mb-3">
                                        <h2>Friends</h2>
                                    </div>
                                    <ul class="list-unstyled friends">
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-7.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-8.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-9.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-10.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                                    alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane " id="activity">

                            <div class="aside-widget">
                                <div class="side-title-alt">
                                    <h2>Recent Activity</h2>
                                </div>
                                <ul class="team-list chat-list-side info">
                                    <li>
                                        <span class="thumb-small">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        <div class="inline">
                                            <span class="name">Mary Brown open a new company</span>
                                            <span class="time">just now</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="thumb-small">
                                            <i class="fa fa-user-plus"></i>
                                        </span>
                                        <div class="inline">
                                            <span class="name">Mary Brown send a new message </span>
                                            <span class="time">50 min ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="thumb-small">
                                            <i class="fa fa-wrench"></i>
                                        </span>
                                        <div class="inline">
                                            <span class="name">Holly Cobb Uploaded 6 new photos.</span>
                                            <span class="time">3 Week Ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="thumb-small">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <div class="inline">
                                            <span class="name">Mary Brown open a new company.</span>
                                            <span class="time">1 Month Ago</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="aside-widget">

                                <div class="side-title-alt">
                                    <h2>Events</h2>
                                </div>
                                <ul class="team-list chat-list-side info statistics border-less-list">
                                    <li>
                                        <div class="inline">
                                            <p class="mb-1">Jamie Miller</p>
                                            <span class="name">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text.</span>
                                            <span class="time text-muted">2 Week Ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="inline">
                                            <p class="mb-1">Robert Jones</p>
                                            <span class="name">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting .</span>
                                            <span class="time text-muted">1 Month Ago</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane " id="settings">
                            <div class="side-title-alt">
                                <h6 class="mb-0">Account Setting</h6>
                            </div>
                            <ul class="team-list chat-list-side info statistics border-less-list setting-list">
                                <li>
                                    <div class="inline">
                                        <span class="name">Auto updates</span>
                                    </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e"
                                            data-size="small" />
                                    </span>
                                </li>
                                <li>
                                    <div class="inline">
                                        <span class="name">Show offline Contacts</span>
                                    </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e"
                                            data-size="small" />
                                    </span>
                                </li>

                                <li>
                                    <div class="inline">
                                        <span class="name">Location Permission</span>
                                    </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e"
                                            data-size="small" />
                                    </span>
                                </li>
                            </ul>

                            <div class="side-title-alt">
                                <h6 class="mb-0">General Setting</h6>
                            </div>
                            <ul class="team-list chat-list-side info statistics border-less-list setting-list">
                                <li>
                                    <div class="inline">
                                        <span class="name">Show me Online</span>
                                    </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e"
                                            data-size="small" />
                                    </span>
                                </li>
                                <li>
                                    <div class="inline">
                                        <span class="name">Status visible to all</span>
                                    </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e"
                                            data-size="small" />
                                    </span>
                                </li>

                                <li>
                                    <div class="inline">
                                        <span class="name">Notifications</span>
                                    </div>
                                    <span class="thumb-small">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e"
                                            data-size="small" />
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--end Right Slidebar-->
        </div>
        <!--end body content-->
    </section>


    <!-- Scripts -->
    {{--  <script src="{{ asset('js/app.js') }}" defer></script>  --}}

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/slidebars.min.js') }}"></script>
    <script src="{{ asset('assets/js/cropper.min.js') }}"></script>

    <!--plugins js-->
    <script src="{{ asset('assets/plugins/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline-chart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.sparkline.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris-chart/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris-chart/morris.js') }}"></script>


    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/exceljs.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.selection.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.orderBars.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.crosshair.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-chart/jquery.flot.axislabels.js') }}"></script>

    <script src="{{ asset('app_js_functions/state_using_pai_chart.js') }}"></script>

    <script src="{{ asset('assets/plugins/fullcalendar2/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/pages/calendar-init.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery.validate/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('charts/Chart.min.js') }}"></script>
    <script src="{{ asset('charts/amcharts.js') }}"></script>
    <script src="{{ asset('charts/serial.js') }}"></script>
    <script src="{{ asset('croppie/croppie.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/notify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/notify-metro.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/notifications.js') }}"></script>
    <script src="https://kit.fontawesome.com/f186debb04.js" crossorigin="anonymous"></script>

    @yield('script')
    <script>
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });
            $('select').select2();
        });

        function toggleCSS() {
            var userId = "{{ Auth::id() }}";
            var settings = "2";
            var url = '{{ route('layout.settings.store', [':userId', ':settings']) }}';
            url = url.replace(':userId', userId);
            url = url.replace(':settings', settings);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Handle the response data here
                    console.log(response);
                },
            });
            var baseCSSUrl = "{{ asset('assets/css') }}";
            var cssLink = document.getElementById('css-link');
            var currentHref = cssLink.getAttribute('href');
            var defaultCSS = '/style.css';
            var secondaryCSS = '/style-secondary.css';

            if (currentHref.endsWith(defaultCSS)) {
                cssLink.setAttribute('href', baseCSSUrl + secondaryCSS);
            } else {
                cssLink.setAttribute('href', baseCSSUrl + defaultCSS);
            }
        }
        $(document).ready(function() {
            $('.table').DataTable();
            $('.dropify').dropify();
        });

        //         $(window).on('load', function() {
        //       // Remove class
        //       $('.text-dark').removeClass('save-btn');

        //       // Add class
        //       $('.text-dark').addClass('save-btn');
        //     });

        //     $(window).on('load', function() {
        //       // Remove class
        //       $('.save-btn').removeClass('text-dark');

        //       $('.save-btn').addClass('bg-white');

        //     });

        //     // $(window).on('load', function() {
        //     $('.p-2').removeClass('bg-info').addClass('bg-danger');
        // //   });
    </script>
</body>

</html>
