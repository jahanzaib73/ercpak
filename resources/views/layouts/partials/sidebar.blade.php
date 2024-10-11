<div class="sidebar-left">
    <div class="sidebar-left-info">

        <div class="user-box">
            <div class="d-flex justify-content-center">
                <img src="{{ Auth::user()->profile_pic_url ? Auth::user()->profile_pic_url : asset('favicon.png') }}"
                    alt="" class="img-fluid rounded-circle">
            </div>
            <div class="text-center text-white mt-2">
                <h6>{{ ucfirst(Auth::user()->full_name) }}</h6>
                {{--  <p class="text-muted m-0">Role: ({{ ucfirst(optional(Auth::user()->role)->name) }})</p>  --}}
            </div>
        </div>

        <!--sidebar nav start-->
        <ul class="side-navigation">
            <li>
                <h3 class="navigation-title">Navigation</h3>
            </li>

            <li class="@yield('dashboard-active-class')">
                <a href="{{ route('home') }}"><i class="mdi mdi-gauge"></i> <span>Dashboard</span></a>
            </li>


            @if (Auth::user()->hasAnyPermission(['All Document', 'All Document Type']))
                @php
                    $documentControlContent = View::getSection('document-control-active-class');
                    $documentTypeContent = View::getSection('document-type-active-class');

                    $documentControlNavActive = false;

                    if ($documentControlContent) {
                        $documentControlNavActive = $documentControlContent ? true : false;
                    }
                    if ($documentTypeContent) {
                        $documentControlNavActive = $documentTypeContent ? true : false;
                    }

                @endphp
                <li class="menu-list @if ($documentControlNavActive) nav-active @endif d-none">
                    <a href="">
                        <i class="mdi mdi-file-multiple"></i> <span>Document Control</span>
                    </a>

                    <ul class="child-list" style="@if (!$documentControlNavActive) display: none; @endif">
                        @if (Auth::user()->hasPermissionTo('All Document Type'))
                            <li class="@yield('document-type-active-class')">
                                <a href="{{ route('document-types.index') }}">
                                    <span>Document
                                        Types</span></a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Document'))
                            <li class="@yield('document-control-active-class')">
                                <a href="{{ route('documents-control.index') }}"></i>
                                    <span>Document Control</span></a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

            @if (Auth::user()->hasAnyPermission(['All Government', 'All Department']))
                @php
                    $departmentContent = View::getSection('department-active-class');
                    $governmentContent = View::getSection('government-active-class');

                    $departmentNavActiveFlag = false;

                    if ($departmentContent) {
                        $departmentNavActiveFlag = $departmentContent ? true : false;
                    }
                    if ($governmentContent) {
                        $departmentNavActiveFlag = $governmentContent ? true : false;
                    }

                @endphp


                <li class="menu-list @if ($departmentNavActiveFlag) nav-active @endif">
                    <a href="">
                        <i class="mdi mdi-bank"></i> <span>Department/Ministry</span>
                    </a>

                    <ul class="child-list" style="@if (!$departmentNavActiveFlag) display: none; @endif">
                        @if (Auth::user()->hasPermissionTo('All Government'))
                            <li class="@yield('government-active-class')"><a href="{{ route('government.index') }}"> Government</a></li>
                        @endif
                        @if (Auth::user()->hasPermissionTo('All Department'))
                            <li class="@yield('department-active-class')"><a href="{{ route('departments.index') }}"> Department</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (Auth::user()->hasAnyPermission(['All Complaint Type', 'All Complaint']))
                @php
                    $complaintTypeContent = View::getSection('complaint-type-active-class');
                    $complaint = View::getSection('complaint-active-class');

                    $complaintActiveFlag = false;

                    if ($complaintTypeContent) {
                        $complaintActiveFlag = $complaintTypeContent ? true : false;
                    }
                    if ($complaint) {
                        $complaintActiveFlag = $complaint ? true : false;
                    }

                @endphp


                <li class="menu-list @if ($complaintActiveFlag) nav-active @endif d-none">
                    <a href="">
                        <i class="mdi mdi-inbox"></i> <span>Complaints</span>
                    </a>

                    <ul class="child-list" style="@if (!$complaintActiveFlag) display: none; @endif">
                        @if (Auth::user()->hasPermissionTo('All Complaint Type'))
                            <li class="@yield('complaint-type-active-class')">
                                <a href="{{ route('complaint-types.index') }}"><span>Complaint
                                        Types</span></a>
                        @endif
                </li>
                @if (Auth::user()->hasPermissionTo('All Complaint'))
                    <li class="@yield('complaint-active-class')"><a href="{{ route('complaints.index') }}"> Complaints</a></li>
                @endif
        </ul>
        </li>
        @endif
        @if (Auth::user()->hasAnyPermission(['All Flight Type', 'All Aircraft Type', 'All Flight and Cargo']))
            @php
                $yieldContent = View::getSection('flight_cargo_type-active-class');
                $flightTypeSec = View::getSection('flight-type-active-class');
                $aircraftType = View::getSection('aircraft-type-active-class');
                $flightCargo = View::getSection('flight_and_cargo-active-class');

                $navActiveFlag = false;

                if ($yieldContent) {
                    $navActiveFlag = $yieldContent ? true : false;
                }
                if ($flightTypeSec) {
                    $navActiveFlag = $flightTypeSec ? true : false;
                }
                if ($aircraftType) {
                    $navActiveFlag = $aircraftType ? true : false;
                }
                if ($flightCargo) {
                    $navActiveFlag = $flightCargo ? true : false;
                }
            @endphp
            <li class="menu-list @if ($navActiveFlag) nav-active @endif d-none">
                <a href="">
                    <i class="mdi mdi-airplane-takeoff"></i> <span>Flights & Cargo</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('All Flight Type'))
                        <li class="@yield('flight-type-active-class')"><a href="{{ route('flight-type.index') }}"> Flight Type</a></li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Aircraft Type'))
                        <li class="@yield('aircraft-type-active-class')"><a href="{{ route('aircraft-type.index') }}"> Aircraft Type</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Flight and Cargo'))
                        <li class="@yield('flight_and_cargo-active-class')"><a
                                href="{{ route('flight-and-cargos.index', ['module_name' => 'record_by_flight']) }}">
                                Flight &
                                Cargo</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (Auth::user()->hasPermissionTo('All Protocol and Liaison'))
            <li class="@yield('protocol-liaison-active-class')">
                <a
                    href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::OFFICIAL]) }}"><i
                        class="mdi mdi-gauge"></i> <span>Protocol &
                        Liaisons</span></a>
            </li>
        @endif

        @if (Auth::user()->hasAnyPermission([
                'Meeting Clander View',
                'All Remainder Type',
                'All Issuing Authority',
                'All Remainder',
            ]))
            @php
                $meetingContent = View::getSection('meeting-active-class');
                $remainderTypeContent = View::getSection('remainder-type-active-class');
                $issuingAuthorityContent = View::getSection('issuing-authority-active-class');
                $remainderContent = View::getSection('remainder-active-class');

                $navActiveFlag = false;

                if ($meetingContent) {
                    $navActiveFlag = $meetingContent ? true : false;
                }

                if ($remainderTypeContent) {
                    $navActiveFlag = $remainderTypeContent ? true : false;
                }
                if ($remainderContent) {
                    $navActiveFlag = $remainderContent ? true : false;
                }
                if ($issuingAuthorityContent) {
                    $navActiveFlag = $issuingAuthorityContent ? true : false;
                }
            @endphp
            <li class="menu-list @if ($navActiveFlag) nav-active @endif d-none">
                <a href="">
                    <i class="fa fa-meetup"></i> <span>Meetings & Remainders</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('Meeting Clander View'))
                        <li class="@yield('meeting-active-class')"><a href="{{ route('meetings.clanderView') }}"> Meetings</a></li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Remainder Type'))
                        <li class="@yield('remainder-type-active-class')"><a href="{{ route('remainders-types.index') }}"> Remainders
                                Type</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Issuing Authority'))
                        <li class="@yield('issuing-authority-active-class')"><a href="{{ route('issuing-authorities.index') }}"> Issuing
                                Authority</a></li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Remainder'))
                        <li class="@yield('remainder-active-class')"><a href="{{ route('remainders.index') }}"> Remainders</a></li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->hasAnyPermission([
                'All Country',
                'All Province',
                'All City',
                'All Location',
                'All Designation',
                'All User Management',
            ]))
            @php
                $userActiveContent = View::getSection('user-active-class');
                $locationActiveContent = View::getSection('location-active-class');
                $desiginationActiveContent = View::getSection('desigination-active-class');
                $countryActiveContent = View::getSection('country-active-class');
                $provinceActiveContent = View::getSection('province-active-class');
                $cityActiveContent = View::getSection('city-active-class');
                $costCenterActiveContent = View::getSection('cost-center-active-class');

                $userManagementActiveFlag = false;

                if ($costCenterActiveContent) {
                    $userManagementActiveFlag = $costCenterActiveContent ? true : false;
                }

                if ($userActiveContent) {
                    $userManagementActiveFlag = $userActiveContent ? true : false;
                }

                if ($cityActiveContent) {
                    $userManagementActiveFlag = $cityActiveContent ? true : false;
                }

                if ($provinceActiveContent) {
                    $userManagementActiveFlag = $provinceActiveContent ? true : false;
                }

                if ($countryActiveContent) {
                    $userManagementActiveFlag = $countryActiveContent ? true : false;
                }

                if ($desiginationActiveContent) {
                    $userManagementActiveFlag = $desiginationActiveContent ? true : false;
                }

                if ($locationActiveContent) {
                    $userManagementActiveFlag = $locationActiveContent ? true : false;
                }

            @endphp


            <li class="menu-list @if ($userManagementActiveFlag) nav-active @endif">
                <a href="">
                    <i class="mdi mdi-account-multiple-plus"></i> <span>User Management</span>
                </a>

                <ul class="child-list" style="@if (!$userManagementActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('All Location'))
                        <li class="@yield('location-active-class')"><a href="{{ route('locations.index') }}">
                                <span>Locations</span></a>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Country'))
                        <li class="@yield('country-active-class')"><a href="{{ route('countries.index') }}">
                                <span>Country</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Province'))
                        <li class="@yield('province-active-class')"><a href="{{ route('provinces.index') }}">
                                <span>Provinces</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All City'))
                        <li class="@yield('city-active-class')"><a href="{{ route('cities.index') }}"> <span>Cities</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Designation'))
                        <li class="@yield('desigination-active-class')"><a href="{{ route('desiginations.index') }}">
                                <span>Designation</span></a>
                        </li>
                    @endif

                    @if (Auth::user()->hasPermissionTo('All Designation'))
                        <li class="@yield('cost-center-active-class')"><a href="{{ route('cost-centers.index') }}">
                                <span>Cost Center</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All User Management'))
                        <li class="@yield('user-active-class')"><a href="{{ route('users.index') }}"> <span>User
                                    Management</span></a>
                        </li>
                    @endif
            </li>
            </ul>
            </li>
        @endif


        @if (Auth::user()->hasAnyPermission(['All Guest and Visitors', 'All Purpose of Visit']))
            @php
                $guestvisitorSection = View::getSection('guest-vistor-active-class');
                $purposeofvisitSection = View::getSection('purpose-visit-active-class');

                $navActiveFlag = false;

                if ($guestvisitorSection) {
                    $navActiveFlag = $guestvisitorSection ? true : false;
                }

                if ($purposeofvisitSection) {
                    $navActiveFlag = $purposeofvisitSection ? true : false;
                }

            @endphp
            <li class="menu-list @if ($navActiveFlag) nav-active @endif">
                <a href="">
                    <i class="mdi mdi-account"></i> <span>Guest & Customers</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('All Guest and Visitors'))
                        <li class="@yield('guest-vistor-active-class')">
                            <a
                                href="{{ route('guest-and-visitors.index', ['module_name' => App\Models\GuestVistor::GUEST]) }}">
                                <span>Guest & Customers</span></a>
                        </li>
                        <li class="@yield('guest-vistor-active-class')">
                            <a
                                href="{{ route('guest-and-visitors.bulk', ['module_name' => App\Models\GuestVistor::GUEST]) }}">
                                <span>Guest & Customers Bulk Upload</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Purpose of Visit'))
                        <li class="@yield('purpose-visit-active-class')">
                            <a href="{{ route('purpose-of-visits.index') }}"><span>Purpose of Visit</span></a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->hasAnyPermission(['All Task Category', 'All Tasks']))
            @php
                $taskCategory = View::getSection('task-category-active-class');
                $task = View::getSection('task-active-class');

                $navActiveFlag = false;

                if ($taskCategory) {
                    $navActiveFlag = $taskCategory ? true : false;
                }
                if ($task) {
                    $navActiveFlag = $task ? true : false;
                }

            @endphp
            <li class="menu-list @if ($navActiveFlag) nav-active @endif d-none">
                <a href="">
                    <i class="mdi mdi-file-check"></i> <span>Tasks</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('All Task Category'))
                        <li class="@yield('task-category-active-class')"><a href="{{ route('task-categories.index') }}"> Task
                                Category</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Tasks'))
                        <li class="@yield('task-active-class')"><a href="{{ route('tasks.index') }}"> Tasks</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (Auth::user()->hasPermissionTo('All Courier'))
            <li class="@yield('courier-active-class') d-none">
                <a href="{{ route('couriers.index') }}"><i class="mdi mdi-gauge"></i> <span>Couriers</span></a>
            </li>
        @endif

        {{--  @if (Auth::user()->hasAnyPermission(['All Guest and Visitors', 'All Purpose of Visit']))  --}}
        @php
            $vehicleMakeSection = View::getSection('vehicle-make-active-class');
            $vehicleModelSection = View::getSection('vehicle-model-active-class');
            $vehicleTypeSection = View::getSection('vehicle-type-active-class');
            $fuelTypeSection = View::getSection('fuel-type-active-class');
            $vehicleSection = View::getSection('vehicle-active-class');
            $tripSection = View::getSection('trip-active-class');
            $fuelSection = View::getSection('fuel-active-class');
            $inspectionSection = View::getSection('inspection-active-class');
            $checklistSection = View::getSection('checklist-active-class');
            $vendorSection = View::getSection('vendor-active-class');
            $taskWorkorderSection = View::getSection('task-workorder-active-class');
            $workorderSection = View::getSection('workorder-active-class');

            $navActiveFlag = false;

            if ($workorderSection) {
                $navActiveFlag = $workorderSection ? true : false;
            }

            if ($taskWorkorderSection) {
                $navActiveFlag = $taskWorkorderSection ? true : false;
            }

            if ($checklistSection) {
                $navActiveFlag = $checklistSection ? true : false;
            }

            if ($vendorSection) {
                $navActiveFlag = $vendorSection ? true : false;
            }

            if ($fuelSection) {
                $navActiveFlag = $fuelSection ? true : false;
            }

            if ($inspectionSection) {
                $navActiveFlag = $inspectionSection ? true : false;
            }

            if ($tripSection) {
                $navActiveFlag = $tripSection ? true : false;
            }

            if ($vehicleMakeSection) {
                $navActiveFlag = $vehicleMakeSection ? true : false;
            }

            if ($vehicleModelSection) {
                $navActiveFlag = $vehicleModelSection ? true : false;
            }

            if ($vehicleTypeSection) {
                $navActiveFlag = $vehicleTypeSection ? true : false;
            }

            if ($fuelTypeSection) {
                $navActiveFlag = $fuelTypeSection ? true : false;
            }

            if ($vehicleSection) {
                $navActiveFlag = $vehicleSection ? true : false;
            }

        @endphp

        @if (Auth::user()->hasAnyPermission([
                'All Vehicle Make',
                'All Vehicle Model',
                'All Vehicle Type',
                'All Fuel Type',
                'All Vehicles',
                'All Trips',
                'All Fuels Slip',
                'All Inspection Check List',
                'All Vendors',
                'All Task Workorders',
                'All Inspection',
                'All Work Orders',
            ]))

            <li class="menu-list @if ($navActiveFlag) nav-active @endif d-none">
                <a href="">
                    <i class="mdi mdi-car"></i> <span>Fleet Management</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('All Vehicle Make'))
                        <li class="@yield('vehicle-make-active-class')">
                            <a href="{{ route('vehicle.make') }}">
                                <span>Vehicle Make</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Vehicle Model'))
                        <li class="@yield('vehicle-model-active-class')">
                            <a href="{{ route('vehicle.models') }}"><span>Vehicle Model</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Vehicle Type'))
                        <li class="@yield('vehicle-type-active-class')">
                            <a href="{{ route('vehicle.type') }}"><span>Vehicle Type</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Fuel Type'))
                        <li class="@yield('fuel-type-active-class')">
                            <a href="{{ route('fuel.type') }}"><span>Fuel Type</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Vehicles'))
                        <li class="@yield('vehicle-active-class')">
                            <a href="{{ route('vehicles.index') }}"><span>Vehicles</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Trips'))
                        <li class="@yield('trip-active-class')">
                            <a href="{{ route('trips.index') }}"><span>Trips</span></a>
                        </li>
                    @endif

                    @if (Auth::user()->hasPermissionTo('All Fuels Slip'))
                        <li class="@yield('fuel-active-class')">
                            <a href="{{ route('fuels.index') }}"><span>Fuels</span></a>
                        </li>
                    @endif

                    @if (Auth::user()->hasPermissionTo('All Inspection Check List'))
                        <li class="@yield('checklist-active-class')">
                            <a href="{{ route('inspection-checklist') }}"><span>Inspections Checklist</span></a>
                        </li>
                    @endif

                    @if (Auth::user()->hasPermissionTo('All Vendors'))
                        <li class="@yield('vendor-active-class')">
                            <a href="{{ route('vendors') }}"><span>Vendors</span></a>
                        </li>
                    @endif

                    @if (Auth::user()->hasPermissionTo('All Task Workorders'))
                        <li class="@yield('task-workorder-active-class')">
                            <a href="{{ route('task-workorders') }}"><span>Workorder Tasks</span></a>
                        </li>
                    @endif

                    @if (Auth::user()->hasPermissionTo('All Inspection'))
                        <li class="@yield('inspection-active-class')">
                            <a href="{{ route('inspections.index') }}"><span>Inspections</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Work Orders'))
                        <li class="@yield('workorder-active-class')">
                            <a href="{{ route('work-orders.index') }}"><span>Workorder</span></a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{--  @endif  --}}

        @php
            $itemTypeSection = View::getSection('item-type-active-class');
            $itemMakeSection = View::getSection('item-make-active-class');
            $itemCategorySection = View::getSection('item-category-active-class');
            $unitTypeSection = View::getSection('unit-type-active-class');
            $warehouseSection = View::getSection('warehouse-active-class');
            $inventorySection = View::getSection('inventory-active-class');
            $purchaseOrderSection = View::getSection('purchase-orders-active-class');
            $shiftwarehouseSection = View::getSection('shiftwarehouse-active-class');

            $navActiveFlag = false;

            if ($itemTypeSection) {
                $navActiveFlag = $itemTypeSection ? true : false;
            }

            if ($itemMakeSection) {
                $navActiveFlag = $itemMakeSection ? true : false;
            }

            if ($itemCategorySection) {
                $navActiveFlag = $itemCategorySection ? true : false;
            }

            if ($unitTypeSection) {
                $navActiveFlag = $unitTypeSection ? true : false;
            }

            if ($warehouseSection) {
                $navActiveFlag = $warehouseSection ? true : false;
            }

            if ($inventorySection) {
                $navActiveFlag = $inventorySection ? true : false;
            }

            if ($purchaseOrderSection) {
                $navActiveFlag = $purchaseOrderSection ? true : false;
            }

            if ($shiftwarehouseSection) {
                $navActiveFlag = $shiftwarehouseSection ? true : false;
            }

        @endphp


        @if (Auth::user()->hasAnyPermission([
                'All Item Type',
                'All Item Make',
                'All Item Category',
                'All Unit Type',
                'All Warehouses',
                'All Inventories',
                'All Purchase Orders',
                'All Shift Warehouses',
            ]))
            <li class="menu-list @if ($navActiveFlag) nav-active @endif d-none">
                <a href="">
                    <i class="mdi mdi-car"></i> <span>Inventory Management</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('All Item Type'))
                        <li class="@yield('item-type-active-class')">
                            <a href="{{ route('item.type') }}">
                                <span>Item Type</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Item Make'))
                        <li class="@yield('item-make-active-class')">
                            <a href="{{ route('item.make') }}">
                                <span>Item Make</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Item Category'))
                        <li class="@yield('item-category-active-class')">
                            <a href="{{ route('item.category') }}">
                                <span>Item Category</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Unit Type'))
                        <li class="@yield('unit-type-active-class')">
                            <a href="{{ route('unit.type') }}">
                                <span>Unit Type</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Warehouses'))
                        <li class="@yield('warehouse-active-class')">
                            <a href="{{ route('warehouses') }}">
                                <span>Warehouses</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Inventories'))
                        <li class="@yield('inventory-active-class')">
                            <a href="{{ route('inventories.index') }}">
                                <span>Inventories</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Purchase Orders'))
                        <li class="@yield('purchase-orders-active-class')">
                            <a href="{{ route('purchase-orders.index') }}">
                                <span>Purchase Orders</span></a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('All Shift Warehouses'))
                        <li class="@yield('shiftwarehouse-active-class')">
                            <a href="{{ route('shift.warehosue.index') }}">
                                <span>Shift Warehouse</span></a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->hasPermissionTo('All Area'))
            <li class="@yield('erc-active-class') d-none">
                <a href="{{ route('team.managemant.index') }}"><i class="mdi mdi-account"></i> <span>Area
                        Management</span></a>
            </li>
        @endif

        @if (Auth::user()->hasPermissionTo('All Project'))
            <li class="@yield('project-management-active-class') d-none">
                <a href="{{ route('project.managemant.index') }}"><i class="mdi mdi-account"></i> <span>Project
                        Management</span></a>
            </li>
        @endif
        <li class="@yield('leave-active-class') d-none">
            <a href="{{ route('leaves.index') }}"><i class="mdi mdi-account"></i> <span>Leaves</span></a>
        </li>

        @if (Auth::user()->hasPermissionTo('All Request'))
            <li class="@yield('request-management-active-class') d-none">
                <a href="{{ route('requests.index') }}"><i class="mdi mdi-account"></i> <span>Request
                        Management</span></a>
            </li>
        @endif

        @if (Auth::user()->hasAnyPermission(['All Task Category', 'All Tasks']))
            @php
                $taskCategory = View::getSection('report');

                $navActiveFlag = false;

                if ($taskCategory) {
                    $navActiveFlag = $taskCategory ? true : false;
                }

            @endphp
            <li class="menu-list @if ($navActiveFlag) nav-active @endif">
                <a href="">
                    <i class="mdi mdi-chart-line"></i> <span>Reports</span>
                </a>

                <ul class="child-list" style="@if (!$navActiveFlag) display: none; @endif">
                    @if (Auth::user()->hasPermissionTo('Fuel Summary Report'))
                        <li class="@yield('report')"><a target="_blank" href="{{ route('fuel.summary.report') }}">
                                Fuel Summary Report</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('Vehicle Movement'))
                        <li class="@yield('report')"><a target="_blank"
                                href="{{ route('vehicle.movement.report') }}"> Vehicle Movement</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('Guest and Customer Report'))
                        <li class="@yield('report')"><a target="_blank"
                                href="{{ route('guest.customer.report') }}"> Guest & Customer Report</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermissionTo('Guest and Customer Monthly Report'))
                        <li class="@yield('report')"><a target="_blank"
                                href="{{ route('guest.customer.monthwise.report') }}"> Guest & Customer Month Wise
                                Report</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        <li>
            <a href="{{ route('tutorials.index') }} d-none"><i class="mdi mdi-account"></i> <span>Tutorials</span></a>
        </li>
        </ul>
        <!--sidebar nav end-->
    </div>
</div>
