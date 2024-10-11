<!-- Modal -->
<div class="modal fade" id="entryFormModal" tabindex="-1" aria-labelledby="entryFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="entryFormModalLabel">Entry Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <form id="entryForm" action="{{ route('guest-and-visitors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="category" name="category">
                <div class="row mb-3">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="cnic">CNIC <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="cnic" name="cnic" placeholder="Enter CNIC" required>
                            <div id="cnic-suggestions" class="list-group"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="passport_number">Passport #</label>
                            <input type="number" class="form-control" id="passport_number" name="passport_number" placeholder="Enter Passport #" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="vistor_name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="vistor_name" name="vistor_name" placeholder="Enter Full Name" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="specialField">Special Field</label>
                            <input type="text" class="form-control" id="specialField" name="specialField" placeholder="Enter Special Field" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="address">Residence Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Residential Address" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="city_id">City <span class="text-danger">*</span></label>
                            <select class="form-control" id="city_id" name="city_id" required>
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', isset($guestVisitors) ? $guestVisitors->city_id : '') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="vistor_contact">Contact <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="vistor_contact" name="vistor_contact" placeholder="Enter Contacts" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="vistor_email" name="vistor_email" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="date">DateTime</label>
                            <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="date">DOB</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="purpose_of_visit_id">Purpose of Visits <span class="text-danger">*</span></label>
                            <select class="form-control" id="purpose_of_visit_id" name="purpose_of_visit_id" required>
                                <option value="">Select Purpose</option>
                                @foreach ($purposeOfVisits as $purpose)
                                    <option value="{{ $purpose->id }}" {{ old('purpose_of_visit_id', isset($guestVisitors) ? $guestVisitors->purpose_of_visit_id : '') == $purpose->id ? 'selected' : '' }}>
                                        {{ $purpose->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 d-none" id="department_ministry">
                        <div class="form-group">
                            <label for="department_id">Department/Ministry <span class="text-danger">*</span></label>
                            <select class="form-control" id="department_id" name="department_id">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', isset($guestVisitors) ? $guestVisitors->department_id : '') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', isset($guestVisitors) ? $guestVisitors->gender : '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', isset($guestVisitors) ? $guestVisitors->gender : '') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <label for="photo">Photo</label>
                        <div class="input-group">
                            <div class="input-group choseFileInputs">
                                <input type="file" class="form-control chooser" name="visitor_photo" id="visitor_photo" accept="image/*">
                                <label class="input-group-text bg-danger text-white" for="visitor_photo">Browse</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-10 p-0">
                        <img id="photoPreview" style="max-width: 100%; display: none;">
                        <input type="hidden" id="croppedImage" name="croppedImage">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-success" style="display: none;" id="cropButton">Crop Photo</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="saveButton">Save</button>
            </div>
        </form>

<!--             <form id="entryForm" action="{{ route('guest-and-visitors.store') }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <input type="hidden" id="category" name="category">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="cnic">CNIC</label>
                                <input type="number" class="form-control" id="cnic" name="cnic"
                                    placeholder="Enter CNIC" required>
                                <div id="cnic-suggestions" class="list-group"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="passport_number">Passport #</label>
                                <input type="number" class="form-control" id="passport_number" name="passport_number"
                                    placeholder="Enter Passport #" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="vistor_name">Full Name</label>
                                <input type="text" class="form-control" id="vistor_name" name="vistor_name"
                                    placeholder="Enter Full Name" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group" id="specialFieldGroup">
                                <label for="specialField">Special Field</label>
                                <input type="text" class="form-control" id="specialField" name="specialField"
                                    placeholder="Enter Special Field" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="address">Residence Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Residential Address" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select class="form-control" id="city_id" name="city_id" required>
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ old('city_id', isset($guestVisitors) ? $guestVisitors->city_id : '') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="vistor_contact">Contact</label>
                                <input type="number" class="form-control" id="vistor_contact" name="vistor_contact"
                                    placeholder="Enter Contacts" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="vistor_email" name="vistor_email"
                                    placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="date">DateTime</label>
                                <input type="datetime-local" class="form-control" id="date_time" name="date_time"
                                    required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="date">DOB</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="purpose_of_visit_id">Purpose of Visits</label>
                                <select class="form-control" id="purpose_of_visit_id" name="purpose_of_visit_id" required>
                                    <option value="">Select Purpose</option>
                                    @foreach ($purposeOfVisits as $purpose)
                                        <option value="{{ $purpose->id }}"
                                            {{ old('purpose_of_visit_id', isset($guestVisitors) ? $guestVisitors->purpose_of_visit_id : '') == $purpose->id ? 'selected' : '' }}>
                                            {{ $purpose->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 d-none" id="department_ministry">
                            <div class="form-group">
                                <label for="department_id">Department/Ministry</label>
                                <select class="form-control" id="department_id" name="department_id">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id', isset($guestVisitors) ? $guestVisitors->department_id : '') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male"
                                        {{ old('gender', isset($guestVisitors) ? $guestVisitors->gender : '') == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="Female"
                                          {{ old('gender', isset($guestVisitors) ? $guestVisitors->gender : '') == 'Female' ? 'selected' : '' }}>
                                          Female
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <label for="photo">Photo</label>
                            <div class="input-group">
                                <div class="input-group choseFileInputs">
                                    <input type="file" class="form-control chooser" name="visitor_photo"
                                        id="visitor_photo" accept="image/*">
                                    <label class="input-group-text bg-danger text-white"
                                        for="visitor_photo">Browse</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-10 p-0">
                            <img id="photoPreview" style="max-width: 100%; display: none;">
                            <input type="hidden" id="croppedImage" name="croppedImage">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-success" style="display: none;" id="cropButton">Crop
                            Photo</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="saveButton">Save</button>
                </div>
            </form> -->
        </div>
    </div>
</div>
