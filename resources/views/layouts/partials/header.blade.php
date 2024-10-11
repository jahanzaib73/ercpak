<div class="header-section">
    <!--logo and logo icon start-->
    <div class="logo" style="background:transparent">
        <a href="{{ route('home') }}">
            <span class="logo-img">
                <img src="{{ asset('EyeTech Logo2.png') }}" alt="" class="w-75">
            </span>
            <!--<i class="fa fa-maxcdn"></i>-->
            {{-- <span class="brand-name" style="font-size: 35px">EYETECH Solutions</span> --}}
        </a>
    </div>

    <!--toggle button start-->
    <a class="toggle-btn"><i class="ti ti-menu"></i></a>
    <!--toggle button end-->

    <!--mega menu start-->
    <div id="navbar-collapse-1" class="navbar-collapse collapse mega-menu">
        <ul class="nav navbar-nav">
            <!-- Classic dropdown -->
            {{--  <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class=""> English <i class="mdi mdi-chevron-down"></i> </a>
                <ul role="menu" class="dropdown-menu language-switch">
                    <li>
                        <a tabindex="-1" href="javascript:;"> German </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="javascript:;"> Italian </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="javascript:;"> French </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="javascript:;"> Spanish </a>
                    </li>
                    <li>
                        <a tabindex="-1" href="javascript:;"> Russian </a>
                    </li>
                </ul>
            </li>  --}}
            <!-- Classic list -->
            {{--  <li>
                <form class="search-content" action="index.html" method="post">
                    <input type="text" class="form-control mt-3" name="keyword" placeholder="Search...">
                    <span class="search-button"><i class="ti ti-search"></i></span>
                </form>
            </li>  --}}
        </ul>
    </div>
    <!--mega menu end-->

    <div class="notification-wrap">
        <!--right notification start-->
        <div class="right-notification d-flex align-items-center">
            <div>
            <button class="toggler-btn py-2 px-3" onclick="toggleCSS()">Change Color</button>
            </div>
            <ul class="notification-menu mb-1">
                {{--  <li>
                    <a href="javascript:;" class="notification" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class=""badge badge-danger">4</span>
                    </a>
                    <ul class="dropdown-menu mailbox dropdown-menu-right">
                        <li>
                          <div class="drop-title">Notifications</div>
                        </li>
                        <li class="notification-scroll">
                            <div class="message-center">
                                <a href="#">
                                    <div class="user-img">
                                        <i class="ti ti-star"></i>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Jane A. Seward</h6>
                                        <span class="mail-desc">Iwon meddle and...</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="user-img">
                                        <i class="ti ti-heart"></i>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Michael W. Salazar</h6>
                                        <span class="mail-desc">Lovely gide learn for you...</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="user-img">
                                        <i class="ti ti-image"></i>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>David D. Chen</h6>
                                        <span class="mail-desc">Send his new photo...</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="user-img">
                                        <i class="ti ti-bell"></i>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Irma J. Hendren</h6>
                                        <span class="mail-desc">6:00 pm our meeting so...</span>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="text-center bg-light" href="javascript:void(0);">
                                <strong>See all notifications</strong>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="notification" data-toggle="dropdown">
                        <i class="mdi mdi-email-outline"></i>
                        <span class="badge badge-danger">9</span>
                    </a>
                    <ul class="dropdown-menu mailbox dropdown-menu-right">
                        <li>
                            <div class="drop-title">New Messages 5</div>
                        </li>
                        <li class="notification-scroll">
                            <div class="message-center">
                                <a href="#">
                                    <div class="user-img">
                                         <img src="assets/images/users/avatar-2.jpg" alt="user" class="rounded-circle">
                                         <span class="profile-status online pull-right"></span>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Cassie T. Bishop</h6>
                                        <span class="mail-desc">Just see the my admin!</span>
                                        <span class="time">9:30 AM</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="user-img">
                                        <img src="assets/images/users/avatar-3.jpg" alt="user" class="rounded-circle">
                                        <span class="profile-status busy pull-right"></span>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Rudy A. Scott</h6>
                                        <span class="mail-desc">Ive sung a song! See you at</span> <span class="time">9:10 AM</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="user-img">
                                        <img src="assets/images/users/avatar-4.jpg" alt="user" class="rounded-circle">
                                        <span class="profile-status away pull-right"></span>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Kevin D. Jernigan</h6>
                                        <span class="mail-desc">I am a singer!</span>
                                        <span class="time">9:08 AM</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="user-img">
                                        <img src="assets/images/users/avatar-5.jpg" alt="user" class="rounded-circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </div>
                                    <div class="mail-contnet">
                                        <h6>Jane A. Seward</h6>
                                        <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="text-center bg-light" href="javascript:void(0);"> <strong>See all notifications</strong> </a>
                        </li>
                    </ul>
                </li>  --}}

                <li>
                    <a href="javascript:;" data-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_pic_url ? Auth::user()->profile_pic_url : asset('favicon.png') }}"
                            alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-menu">
                        <a class="dropdown-item" href="{{ route('users.get.profile') }}"><i
                                class="mdi mdi-account-circle m-r-5 text-muted"></i>
                            Profile</a>
                        @if (isSuperAdmin())
                            <a class="dropdown-item" href="{{ route('take.backup') }}"><i
                                    class="mdi mdi-briefcase-download m-r-5 text-muted"></i>
                                Take Backup</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('employee.managemant.mark.attandance') }}"><i
                                class="mdi mdi-account-circle m-r-5 text-muted"></i>
                            Attandance</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </li>

                {{--  <li>
                    <div class="sb-toggle-right">
                        <i class="mdi mdi-apps"></i>
                    </div>
                </li>  --}}
            </ul>
        </div>
        <!--right notification end-->
    </div>
</div>
