@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
        data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h2 class="brand-text mb-0">AE ERCPAK</h2>
                    </a>
                </li>
            </ul>
        </div>
    @else
        <nav
            class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
@endif
<div class="navbar-container d-flex content">
    <ul class="nav navbar-nav align-items-center ms-auto">
        <li class="nav-item dropdown dropdown-language">
            <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                aria-haspopup="true">
                <i class="flag-icon flag-icon-us"></i>
                <span class="selected-language">English</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
                    <i class="flag-icon flag-icon-us"></i> English
                </a>
                <a class="dropdown-item" href="{{ url('lang/fr') }}" data-language="fr">
                    <i class="flag-icon flag-icon-fr"></i> French
                </a>
                <a class="dropdown-item" href="{{ url('lang/de') }}" data-language="de">
                    <i class="flag-icon flag-icon-de"></i> German
                </a>
                <a class="dropdown-item" href="{{ url('lang/pt') }}" data-language="pt">
                    <i class="flag-icon flag-icon-pt"></i> Portuguese
                </a>
                <a class="dropdown-item" href="{{ url('lang/ru') }}" data-language="ru">
                    <i class="flag-icon flag-icon-ru"></i> Russian
                </a>
                <a class="dropdown-item" href="{{ url('lang/ch') }}" data-language="ch">
                    <i class="flag-icon flag-icon-cn"></i> Chinese
                </a>
            </div>
        </li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                    data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i></a></li>

        <li class="nav-item dropdown dropdown-notification me-25 d-none">
            <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class="ficon" data-feather="bell"></i>
                <span class="badge rounded-pill bg-danger badge-up">5</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                <li class="dropdown-menu-header">
                    <div class="dropdown-header d-flex">
                        <h4 class="notification-title mb-0 me-auto">{{ __('Notifications') }}</h4>
                        <div class="badge rounded-pill badge-light-primary">6 New</div>
                    </div>
                </li>
                <li class="scrollable-container media-list">
                    <a class="d-flex" href="javascript:void(0)">
                        <div class="list-item d-flex align-items-start">
                            <div class="me-1">
                                <div class="avatar">
                                    <img src="{{ asset('images/portrait/small/avatar-s-15.jpg') }}" alt="avatar"
                                        width="32" height="32">
                                </div>
                            </div>
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!
                                </p>
                                <small class="notification-text"> Won the monthly best seller badge.</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex" href="javascript:void(0)">
                        <div class="list-item d-flex align-items-start">
                            <div class="me-1">
                                <div class="avatar">
                                    <img src="{{ asset('images/portrait/small/avatar-s-3.jpg') }}" alt="avatar"
                                        width="32" height="32">
                                </div>
                            </div>
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p>
                                <small class="notification-text"> You have 10 unread messages</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex" href="javascript:void(0)">
                        <div class="list-item d-flex align-items-start">
                            <div class="me-1">
                                <div class="avatar bg-light-danger">
                                    <div class="avatar-content">MD</div>
                                </div>
                            </div>
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout
                                </p>
                                <small class="notification-text"> MD Inc. order updated</small>
                            </div>
                        </div>
                    </a>
                    <div class="list-item d-flex align-items-center">
                        <h6 class="fw-bolder me-auto mb-0">{{ __('System Notifications') }}</h6>
                        <div class="form-check form-check-primary form-switch">
                            <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                            <label class="form-check-label" for="systemNotification"></label>
                        </div>
                    </div>
                    <a class="d-flex" href="javascript:void(0)">
                        <div class="list-item d-flex align-items-start">
                            <div class="me-1">
                                <div class="avatar bg-light-danger">
                                    <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                </div>
                            </div>
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading"><span class="fw-bolder">Server down</span>&nbsp;registered
                                </p>
                                <small class="notification-text"> USA Server is down due to hight CPU usage</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex" href="javascript:void(0)">
                        <div class="list-item d-flex align-items-start">
                            <div class="me-1">
                                <div class="avatar bg-light-success">
                                    <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading"><span class="fw-bolder">Sales report</span>&nbsp;generated
                                </p><small class="notification-text"> Last month sales report generated</small>
                            </div>
                        </div>
                    </a>
                    <a class="d-flex" href="javascript:void(0)">
                        <div class="list-item d-flex align-items-start">
                            <div class="me-1">
                                <div class="avatar bg-light-warning">
                                    <div class="avatar-content"><i class="avatar-icon"
                                            data-feather="alert-triangle"></i></div>
                                </div>
                            </div>
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage</p>
                                <small class="notification-text"> BLR Server using high memory</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="dropdown-menu-footer">
                    <a class="btn btn-primary w-100" href="javascript:void(0)">{{ __('Read all notifications') }}</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown dropdown-user">
            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                data-bs-toggle="dropdown" aria-haspopup="true">
                <div class="user-nav d-sm-flex d-none">
                    <span class="user-name fw-bolder">
                        @if (Auth::check())
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                        @else
                            User
                        @endif
                    </span>
                    <span class="user-status">
                    </span>
                </div>
                <span class="avatar">
                    @if (isset(Auth::user()->photo) && file_exists('profile/' . Auth::user()->photo))
                        <img src="{{ asset('profile/' . Auth::user()->photo) }}" alt="{{ Auth::user()->photo }}"
                            height="40" width="40">
                    @else
                        <img class="round"
                            src="{{ Auth::user()->profile_pic_url ? Auth::user()->profile_pic_url : asset('favicon.png') }}"
                            alt="" height="40" width="40">
                    @endif
                    <span class="avatar-status-online"></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                <h6 class="dropdown-header">{{ __('Manage Profile') }}</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"
                    href="{{ url('profile.show') ? url('profile.show') : 'javascript:void(0)' }}">
                    <i class="me-50" data-feather="user"></i> {{ __('Profile') }}
                </a>
                <a class="dropdown-item" href="{{ url('/admin/signout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="me-50" data-feather="power"></i> {{ __('Logout') }}
                </a>
                <form method="POST" id="logout-form" action="{{ url('/admin/signout') }}">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>
</nav>

{{-- Search Start Here --}}
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center">
        <a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="me-75">
                    <img src="{{ asset('images/icons/xls.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p>
                    <small class="text-muted">Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;17kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="me-75">
                    <img src="{{ asset('images/icons/jpg.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p>
                    <small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;11kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="me-75">
                    <img src="{{ asset('images/icons/pdf.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p>
                    <small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;150kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="me-75">
                    <img src="{{ asset('images/icons/doc.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p>
                    <small class="text-muted">Web Designer</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;256kb</small>
        </a>
    </li>
    <li class="d-flex align-items-center">
        <a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar me-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p>
                    <small class="text-muted">UI designer</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar me-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p>
                    <small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar me-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-14.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p>
                    <small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar me-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p>
                    <small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a>
    </li>
</ul>

{{-- if main search not found! --}}
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between">
        <a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start">
                <span class="me-75" data-feather="alert-circle"></span>
                <span>No results found.</span>
            </div>
        </a>
    </li>
</ul>
{{-- Search Ends --}}
<!-- END: Header-->
