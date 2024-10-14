@php
    $configData = App\Helpers\Helper::applClasses();
@endphp
{{-- Horizontal Menu --}}
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal
  {{ $configData['horizontalMenuClass'] }}
  {{ $configData['theme'] === 'dark' ? 'navbar-dark' : 'navbar-light' }}
  navbar-shadow menu-border
  {{ $configData['layoutWidth'] === 'boxed' && $configData['horizontalMenuType'] === 'navbar-floating' ? 'container-xxl' : '' }}"
        role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                        y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                        x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path"
                                                d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                style="fill:currentColor"></path>
                                            <path id="Path1"
                                                d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                            </polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                            </polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                                points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                            </polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <h2 class="brand-text mb-0">AE Ercpak</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                {{-- Foreach menu item starts --}}
                <li class="nav-item dropdown {{ Route::currentRouteName() === 'home' ? '' : '' }}">
                    <a href="{{ url('/home') }}" class="nav-link d-flex align-items-center">
                        <i data-feather="home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ Route::currentRouteName() === 'government' ? '' : '' }}"
                    data-menu="dropdown">
                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <i data-feather="globe"></i>
                        <span>{{ __('Government/Ministry') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item {{ Route::currentRouteName() === 'government' ? '' : '' }}">
                            <a href="{{ url('/government') }}" class="nav-link">
                                <span>{{ __('Government') }}</span>
                            </a>
                        </li>
                        <li class="dropdown-item {{ Route::currentRouteName() === 'departments' ? '' : '' }}">
                            <a href="{{ url('/departments') }}" class="nav-link">
                                <span>{{ __('Department') }}</span>
                            </a>
                        </li>
                        <li
                            class="dropdown-item {{ Route::currentRouteName() === 'sub-departments' ? '' : '' }}">
                            <a href="{{ url('/sub-departments') }}" class="nav-link">
                                <span>{{ __('Sub Department') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown" data-menu="dropdown">
                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <i class="mdi mdi-car"></i>
                        <span>{{ __('Fleet Management') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @if (Auth::user()->hasPermissionTo('All Vehicle Make'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'vehicle.make' ? '' : '' }}">
                                <a href="{{ route('vehicle.make') }}" class="nav-link">
                                    <span>{{ __('Vehicle Make') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Vehicle Model'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'vehicle.models' ? '' : '' }}">
                                <a href="{{ route('vehicle.models') }}" class="nav-link">
                                    <span>{{ __('Vehicle Model') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Vehicle Type'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'vehicle.type' ? '' : '' }}">
                                <a href="{{ route('vehicle.type') }}" class="nav-link">
                                    <span>{{ __('Vehicle Type') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Fuel Type'))
                            <li class="dropdown-item {{ Route::currentRouteName() === 'fuel.type' ? '' : '' }}">
                                <a href="{{ route('fuel.type') }}" class="nav-link">
                                    <span>{{ __('Fuel Type') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Vehicles'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'vehicles.index' ? '' : '' }}">
                                <a href="{{ route('vehicles.index') }}" class="nav-link">
                                    <span>{{ __('Vehicles') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Trips'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'trips.index' ? '' : '' }}">
                                <a href="{{ route('trips.index') }}" class="nav-link">
                                    <span>{{ __('Trips') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Fuels Slip'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'fuels.index' ? '' : '' }}">
                                <a href="{{ route('fuels.index') }}" class="nav-link">
                                    <span>{{ __('Fuels') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Inspection Check List'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'inspection-checklist' ? '' : '' }}">
                                <a href="{{ route('inspection-checklist') }}" class="nav-link">
                                    <span>{{ __('Inspections Checklist') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Vendors'))
                            <li class="dropdown-item {{ Route::currentRouteName() === 'vendors' ? '' : '' }}">
                                <a href="{{ route('vendors') }}" class="nav-link">
                                    <span>{{ __('Vendors') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Task Workorders'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'task-workorders' ? '' : '' }}">
                                <a href="{{ route('task-workorders') }}" class="nav-link">
                                    <span>{{ __('Workorder Tasks') }}</span>
                                </a>
                            </li>
                        @endif
                        {{-- @if (Auth::user()->hasPermissionTo('All Inspection'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'inspections.index' ? '' : '' }}">
                                <a href="{{ route('inspections.index') }}" class="nav-link">
                                    <span>{{ __('Inspections') }}</span>
                                </a>
                            </li>
                        @endif --}}
                        @if (Auth::user()->hasPermissionTo('All Work Orders'))
                            <li
                                class="dropdown-item {{ Route::currentRouteName() === 'work-orders.index' ? '' : '' }}">
                                <a href="{{ route('work-orders.index') }}" class="nav-link">
                                    <span>{{ __('Inspections/Workorder') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


                <li class="nav-item dropdown {{ Route::currentRouteName() === 'location' || Route::currentRouteName() === 'country' || Route::currentRouteName() === 'province' || Route::currentRouteName() === 'city' || Route::currentRouteName() === 'designation' || Route::currentRouteName() === 'cost-center' || Route::currentRouteName() === 'user-management' ? '' : '' }}"
                    data-menu="dropdown">
                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <i data-feather="users"></i>
                        <span>{{ __('User Management') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item {{ Route::currentRouteName() === 'location' ? '' : '' }}">
                            <a href="{{ route('locations.index') }}" class="nav-link">
                                <span>{{ __('Locations') }}</span>
                            </a>
                        </li>
                        <li class="dropdown-item {{ Route::currentRouteName() === 'country' ? '' : '' }}">
                            <a href="{{ route('countries.index') }}" class="nav-link">
                                <span>{{ __('Country') }}</span>
                            </a>
                        </li>
                        <li class="dropdown-item {{ Route::currentRouteName() === 'province' ? '' : '' }}">
                            <a href="{{ route('provinces.index') }}" class="nav-link">
                                <span>{{ __('Provinces') }}</span>
                            </a>
                        </li>
                        <li class="dropdown-item {{ Route::currentRouteName() === 'city' ? '' : '' }}">
                            <a href="{{ route('cities.index') }}" class="nav-link">
                                <span>{{ __('Cities') }}</span>
                            </a>
                        </li>
                        <li class="dropdown-item {{ Route::currentRouteName() === 'designation' ? '' : '' }}">
                            <a href="{{ route('desiginations.index') }}" class="nav-link">
                                <span>{{ __('Designation') }}</span>
                            </a>
                        </li>
                        <li class="dropdown-item {{ Route::currentRouteName() === 'cost-center' ? '' : '' }}">
                            <a href="{{ route('cost-centers.index') }}" class="nav-link">
                                <span>{{ __('Cost Center') }}</span>
                            </a>
                        </li>
                        {{-- <li
                            class="dropdown-item {{ Route::currentRouteName() === 'user-management' ? '' : '' }}">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <span>{{ __('User Management') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>


                <li class="nav-item dropdown {{ Route::currentRouteName() === 'guest' || Route::currentRouteName() === 'guest-bulk' || Route::currentRouteName() === 'purpose-visit' ? '' : '' }}"
                    data-menu="dropdown">
                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <i data-feather="user"></i>
                        <span>{{ __('Guest and Customer') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Guest & Customers -->
                        <li class="dropdown-item {{ Route::currentRouteName() === 'guest' ? '' : '' }}">
                            <a href="{{ route('guest-and-visitors.index', ['module_name' => App\Models\GuestVistor::GUEST]) }}"
                                class="nav-link">
                                <span>{{ __('Guest & Customers') }}</span>
                            </a>
                        </li>
                        <!-- Guest & Customers Bulk Upload -->
                        <li class="dropdown-item {{ Route::currentRouteName() === 'guest-bulk' ? '' : '' }}">
                            <a href="{{ route('guest-and-visitors.bulk', ['module_name' => App\Models\GuestVistor::GUEST]) }}"
                                class="nav-link">
                                <span>{{ __('Guest & Customers Bulk Upload') }}</span>
                            </a>
                        </li>
                        <!-- Purpose of Visit -->
                        <li class="dropdown-item {{ Route::currentRouteName() === 'purpose-visit' ? '' : '' }}">
                            <a href="{{ route('purpose-of-visits.index') }}" class="nav-link">
                                <span>{{ __('Purpose of Visit') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- Foreach menu item ends --}}
            </ul>
        </div>
    </div>
</div>
