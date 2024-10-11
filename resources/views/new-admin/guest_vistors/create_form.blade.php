@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Add Guest & Customers (Bulk Upload)')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <style>
        .popup-form {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .preview-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #fff;
            height: 100%;
            overflow-y: auto;
        }

        .preview-photo {
            text-align: center;
            margin-bottom: 15px;
        }

        .preview-photo img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
@endsection
@section('content')

    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 preview-box">
                        <div class="preview-photo">
                            <img id="previewImage" style="max-width:200px"
                                src="{{ $guestVisitor->image_url ?? 'https://via.placeholder.com/150' }}"
                                alt="Photo Preview">
                        </div>
                        <h5>Preview</h5>
                        <p><strong>Full Name:</strong> <span id="previewName">{{ $guestVisitor->vistor_name ?? '-' }}</span>
                        </p>
                        <p><strong>CNIC:</strong> <span id="previewCNIC">{{ $guestVisitor->cnic ?? '-' }}</span></p>
                        <p><strong>Passport #:</strong> <span
                                id="previewPassport">{{ $guestVisitor->passport_number ?? '-' }}</span></p>
                        <p><strong>Designation:</strong> <span
                                id="previewDesignation">{{ $guestVisitor->special_field ?? '-' }}</span></p>
                        <p><strong>Residence Address:</strong> <span
                                id="previewAddress">{{ $guestVisitor->address ?? '-' }}</span></p>
                        <p><strong>City:</strong> <span
                                id="previewCity">{{ optional($guestVisitor->city)->name ?? '-' }}</span></p>
                        <p><strong>Contact:</strong> <span
                                id="previewContact">{{ $guestVisitor->vistor_contact ?? '-' }}</span></p>
                        <p><strong>Email:</strong> <span id="previewEmail">{{ $guestVisitor->vistor_email ?? '-' }}</span>
                        </p>
                        <p><strong>Date & Time:</strong> <span
                                id="previewDateTime">{{ $guestVisitor->date_time ?? '-' }}</span></p>
                        <p><strong>Date of Birth:</strong> <span id="previewDOB">{{ $guestVisitor->dob ?? '-' }}</span></p>
                        <p><strong>Purpose of Visit:</strong> <span
                                id="previewPurpose">{{ optional($guestVisitor->purpose_of_visit)->name ?? '-' }}</span></p>
                        <p><strong>Department/Ministry:</strong> <span
                                id="previewDept">{{ optional($guestVisitor->department)->name ?? '-' }}</span></p>
                        <p><strong>Sub Department:</strong> <span
                                id="previewDept">{{ optional($guestVisitor->subdepartment)->name ?? '-' }}</span></p>
                        <p><strong>Gender:</strong> <span id="previewGender">{{ $guestVisitor->gender ?? '-' }}</span></p>
                    </div>

                    <div class="col-lg-6 col-sm-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5>Entry Form</h5>
                                    <form action="{{ route('guest-and-visitors.update', $guestVisitor->id) }}"
                                        method="POST" enctype="multipart/form-data" class="form form-horizontal">
                                        @csrf
                                        @method('PUT')

                                        <!-- Row 1: CNIC, Passport # -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-card-text"></i> CNIC</label>
                                                <input type="text" class="form-control" id="cnic" name="cnic"
                                                    value="{{ $guestVisitor->cnic }}" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-passport"></i> Passport #</label>
                                                <input type="text" class="form-control" id="passport"
                                                    name="passport_number" value="{{ $guestVisitor->passport_number }}"
                                                    oninput="updatePreview()">
                                            </div>
                                        </div>

                                        <!-- Row 2: Full Name -->
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label class="form-label"><i class="bi bi-person-fill"></i> Full
                                                    Name</label>
                                                <input type="text" class="form-control" id="fullName" name="vistor_name"
                                                    value="{{ $guestVisitor->vistor_name }}" oninput="updatePreview()">
                                            </div>
                                        </div>

                                        <!-- Row 3: Designation, Residence Address -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-briefcase-fill"></i>
                                                    Designation</label>
                                                <input type="text" class="form-control" id="designation"
                                                    name="special_field" value="{{ $guestVisitor->special_field }}"
                                                    oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-house-fill"></i> Residence
                                                    Address</label>
                                                <input type="text" class="form-control" id="residenceAddress"
                                                    name="address" value="{{ $guestVisitor->address }}"
                                                    oninput="updatePreview()">
                                            </div>
                                        </div>

                                        <!-- Row 4: City, Contact, Email -->
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label class="form-label"><i class="bi bi-geo-alt-fill"></i> City</label>
                                                <select class="form-select" id="city" name="city_id"
                                                    onchange="updatePreview()">
                                                    <option value="">Select City</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $guestVisitor->city_id == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="form-label"><i class="bi bi-phone-fill"></i> Contact</label>
                                                <input type="text" class="form-control" id="contact"
                                                    name="vistor_contact" value="{{ $guestVisitor->vistor_contact }}"
                                                    oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="form-label"><i class="bi bi-envelope-fill"></i>
                                                    Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="vistor_email" value="{{ $guestVisitor->vistor_email }}"
                                                    oninput="updatePreview()">
                                            </div>
                                        </div>

                                        <!-- Row 5: Date & Time, Date of Birth -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-calendar2-date-fill"></i> Date &
                                                    Time</label>
                                                <input type="datetime-local" class="form-control" id="dateTime"
                                                    name="date_time"
                                                    value="{{ $guestVisitor->date_time ? Carbon\Carbon::parse($guestVisitor->date_time)->format('Y-m-d\TH:i') : '' }}"
                                                    oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-calendar-fill"></i> Date of
                                                    Birth</label>
                                                <input type="date" class="form-control" id="dob" name="dob"
                                                    value="{{ $guestVisitor->dob }}" oninput="updatePreview()">
                                            </div>
                                        </div>

                                        <!-- Row 6: Purpose of Visit, Department/Ministry -->
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label class="form-label"><i class="bi bi-box-arrow-in-right"></i> Purpose
                                                    of
                                                    Visit</label>
                                                <select class="form-select" id="purpose" name="purpose_of_visit_id"
                                                    onchange="updatePreview()">
                                                    <option value="">Select Purpose</option>
                                                    @foreach ($purposes as $purpose)
                                                        <option value="{{ $purpose->id }}"
                                                            {{ $guestVisitor->purpose_of_visit_id == $purpose->id ? 'selected' : '' }}>
                                                            {{ $purpose->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="form-label"><i class="bi bi-building"></i>
                                                    Department/Ministry</label>
                                                <select class="form-select" id="dept" name="department_id"
                                                    onchange="updatePreview()">
                                                    <option value="">Select Department/Ministry</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}"
                                                            {{ $guestVisitor->department_id == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="form-label"><i class="bi bi-building"></i>
                                                    Sub Department</label>
                                                <select class="form-select" id="dept" name="sub_department_id"
                                                    onchange="updatePreview()">
                                                    <option value="">Select Sub Department</option>
                                                    @foreach ($subdepartments as $subdepartment)
                                                        <option value="{{ $subdepartment->id }}"
                                                            {{ $guestVisitor->sub_department_id == $subdepartment->id ? 'selected' : '' }}>
                                                            {{ $subdepartment->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Row 7: Gender, Photo -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-gender-ambiguous"></i>
                                                    Gender</label>
                                                <select class="form-select" id="gender" name="gender"
                                                    onchange="updatePreview()">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"
                                                        {{ $guestVisitor->gender == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="Female"
                                                        {{ $guestVisitor->gender == 'Female' ? 'selected' : '' }}>
                                                        Female</option>
                                                    <option value="Other"
                                                        {{ $guestVisitor->gender == 'Other' ? 'selected' : '' }}>
                                                        Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="form-label"><i class="bi bi-image"></i> Photo</label>
                                                <input type="file" class="form-control" id="photo"
                                                    name="image_name" accept="image/*"
                                                    onchange="updatePreviewImage(event)">
                                            </div>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary save-btn text-dark ml-2 px-5">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        function updatePreview() {
            document.getElementById('previewName').textContent = document.getElementById('fullName').value;
            document.getElementById('previewCNIC').textContent = document.getElementById('cnic').value;
            document.getElementById('previewPassport').textContent = document.getElementById('passport').value;
            document.getElementById('previewDesignation').textContent = document.getElementById('designation').value;
            document.getElementById('previewAddress').textContent = document.getElementById('residenceAddress').value;
            document.getElementById('previewCity').textContent = document.getElementById('city').value;
            document.getElementById('previewContact').textContent = document.getElementById('contact').value;
            document.getElementById('previewEmail').textContent = document.getElementById('email').value;
            document.getElementById('previewDateTime').textContent = document.getElementById('dateTime').value;
            document.getElementById('previewDOB').textContent = document.getElementById('dob').value;
            document.getElementById('previewPurpose').textContent = document.getElementById('purpose').value;
            document.getElementById('previewDept').textContent = document.getElementById('dept').value;
            document.getElementById('previewGender').textContent = document.getElementById('gender').value;
        }

        function updatePreviewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('previewImage').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
