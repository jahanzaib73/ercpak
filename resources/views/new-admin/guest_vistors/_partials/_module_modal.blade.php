<div class="modal fade" id="entryFormModal" tabindex="-1" aria-labelledby="entryFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1" id="entryFormModalLabel">Entry Form</h1>
                    <p>Please fill in the details below.</p>
                </div>
                <form id="entryForm" class="row gy-1 pt-75" action="{{ route('guest-and-visitors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="category" name="category">

                    <!-- CNIC Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="cnic">CNIC <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="cnic" name="cnic" placeholder="Enter CNIC" required>
                        <div id="cnic-suggestions" class="list-group"></div>
                    </div>

                    <!-- Passport Number Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="passport_number">Passport #</label>
                        <input type="number" class="form-control" id="passport_number" name="passport_number" placeholder="Enter Passport #" required>
                    </div>

                    <!-- Full Name Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="vistor_name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vistor_name" name="vistor_name" placeholder="Enter Full Name" required>
                    </div>

                    <!-- Special Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="specialField">Special Field</label>
                        <input type="text" class="form-control" id="specialField" name="specialField" placeholder="Enter Special Field" required>
                    </div>

                    <!-- Residence Address Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="address">Residence Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Residential Address" required>
                    </div>

                    <!-- City Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="city_id">City <span class="text-danger">*</span></label>
                        <select class="form-control" id="city_id" name="city_id" required>
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', isset($guestVisitors) ? $guestVisitors->city_id : '') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Contact Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="vistor_contact">Contact <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="vistor_contact" name="vistor_contact" placeholder="Enter Contacts" required>
                    </div>

                    <!-- Email Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="vistor_email">Email</label>
                        <input type="email" class="form-control" id="vistor_email" name="vistor_email" placeholder="Enter Email" required>
                    </div>

                    <!-- DateTime Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="date_time">DateTime</label>
                        <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
                    </div>

                    <!-- DOB Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="dob">DOB</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>

                    <!-- Purpose of Visits Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="purpose_of_visit_id">Purpose of Visits <span class="text-danger">*</span></label>
                        <select class="form-control" id="purpose_of_visit_id" name="purpose_of_visit_id" required>
                            <option value="">Select Purpose</option>
                            @foreach ($purposeOfVisits as $purpose)
                                <option value="{{ $purpose->id }}" {{ old('purpose_of_visit_id', isset($guestVisitors) ? $guestVisitors->purpose_of_visit_id : '') == $purpose->id ? 'selected' : '' }}>
                                    {{ $purpose->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department/Ministry Field (Conditional) -->
                    <div class="col-12 col-md-6 d-none" id="department_ministry">
                        <label class="form-label" for="department_id">Department/Ministry <span class="text-danger">*</span></label>
                        <select class="form-control" id="department_id" name="department_id">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', isset($guestVisitors) ? $guestVisitors->department_id : '') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 d-none" id="sub-department_ministry">
                        <label class="form-label" for="sub_department_id">Sub Department/Ministry <span class="text-danger">*</span></label>
                        <select class="form-control" id="sub_department_id" name="sub_department_id">
                            <option value="">Select Sub Department</option>
                            @foreach ($subdepartments as $subdepartment)
                                <option value="{{ $subdepartment->id }}" {{ old('sub_department_id', isset($guestVisitors) ? $guestVisitors->sub_department_id : '') == $subdepartment->id ? 'selected' : '' }}>
                                    {{ $subdepartment->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gender Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', isset($guestVisitors) ? $guestVisitors->gender : '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', isset($guestVisitors) ? $guestVisitors->gender : '') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Photo Upload Field -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="visitor_photo">Photo</label>
                        <div class="input-group mb-3 choseFileInputs">
                            <input type="file" class="form-control chooser" name="visitor_photo" id="visitor_photo" accept="image/*">
                            <label class="input-group-text bg-danger text-white" for="visitor_photo">Browse</label>
                        </div>
                    </div>

                    <!-- Image Crop Preview -->
                    <div class="col-12">
                        <div class="text-center">
                            <img id="photoPreview" style="max-width: 100%; display: none;">
                            <input type="hidden" id="croppedImage" name="croppedImage">
                            <button type="button" class="btn btn-success mt-2" style="display: none;" id="cropButton">Crop Photo</button>
                        </div>
                    </div>

                    <!-- Submit and Reset Buttons -->
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
