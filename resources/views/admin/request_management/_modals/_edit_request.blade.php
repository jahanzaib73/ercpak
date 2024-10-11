<!-- Modal -->
<div class="modal fade" id="editRequestModal" tabindex="-1" aria-labelledby="editRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="editRequestModalLabel">Update Request &nbsp; / &nbsp;</h5>
                <h5 class="modal-title text-white arabic" id="editRequestModalLabel">إضافة طلب </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                {{-- <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Vendor</strong></h3> --}}
               
                <h5 class="modal-title modal-heading text-black" id="editRequestModalLabel">Update Request &nbsp; / &nbsp;</h5>
                <h5 class="modal-title modal-heading text-black arabic" id="editRequestModalLabel">إضافة طلب </h5>
               
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="editRequestForm" action="{{ route('request.managemant.update.requests') }}" method="POST">
                    <input type="hidden" name="id" id="requeestId">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="d-flex justify-content-between">
                                <label for="inputprojectName">Request #</label> <label for=""
                                    class="arabic red">رقم الطلب</label>
                            </div>

                            <input type="text" class="form-control" id="requestEditId" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="request_type_id">Requst Type
                                    @if (Auth::user()->can('All Request Type'))
                                        <a href="{{ route('request-types.index') }}"><i class="fa fa-plus"></i></a>
                                    @endif
                                </label> <label for="" class="arabic red">
                                    نوع الطلب </label>
                            </div>

                            <select id="request_type_id_edit" name="request_type_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($requestTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <div class="d-flex justify-content-between">
                                <label for="request_date">Date</label><label for=""
                                    class="arabic red">تاريخ</label>
                            </div>

                            <input type="date" class="form-control" name="request_date" id="request_date_edit">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="requestee_name">Requestee Name</label> <label for=""
                                    class="arabic red">اسم الطالب </label>
                            </div>

                            <input type="text" class="form-control" id="requestee_name_edit" name="requestee_name">
                        </div>
                        <div class="form-group col-md-3">
                            <div class="d-flex justify-content-between">
                                <label for="age">Age</label> <label for="" class="arabic red">عمر
                                </label>
                            </div>

                            <input type="number" class="form-control" id="age_edit" name="age">
                        </div>
                        <div class="form-group col-md-3">
                            <div class="d-flex justify-content-between">
                                <label for="gender">Gender</label> <label for="" class="arabic red"> جنس
                                </label>
                            </div>

                            <select id="gende_edit" class="form-control" name="gender">
                                <option value="">Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="country_id">Country</label> <label for=""
                                    class="arabic red">دولة</label>
                            </div>

                            <select id="country_id_edit" name="country_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="province_id">Province</label><label for=""
                                    class="arabic red">مقاطعة</label>
                            </div>

                            <select id="province_id_edit" name="province_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="city_id">City</label><label for="" class="arabic red">اسم
                                    المدينة</label>
                            </div>

                            <select id="city_id_edit" name="city_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="contact">Contact</label> <label for=""
                                    class="arabic red">اتصال</label>
                            </div>

                            <input type="text" class="form-control" id="contact_edit" name="contact">
                        </div>
                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="email">Email</label> <label for="" class="arabic red">بريد
                                    إلكتروني</label>
                            </div>

                            <input type="email" class="form-control" id="email_edit" name="email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="funds_requested">Funds Requested</label> <label for=""
                                    class="arabic red">الأموال المطلوبة</label>
                            </div>

                            <input type="number" class="form-control" id="funds_requested_edit"
                                name="funds_requested" placeholder="0.00">
                        </div>
                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="currency_id">Currency</label> <label for=""
                                    class="arabic red">عملة</label>
                            </div>
                            <select id="currency_id_edit" name="currency_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="d-flex justify-content-between">
                                <label for="status">Status</label> <label for="" class="arabic red"> جنس
                                </label>
                            </div>

                            <select id="status" class="form-control" name="status">
                                <option value="">Choose...</option>
                                <option value="1">Inprogress</option>
                                <option value="2">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="notes">Notes</label>
                            <textarea name="notes" type="text" class="form-control" id="notes_edit" cols="30" rows="2"></textarea>
                        </div>
                        <div class="form-group col-12 text-right">
                            <label for="notes_arabic" class="arabic red">ملحوظات</label>
                            <textarea name="notes_arabic" type="text" class="form-control text-right" id="notes_arabic_edit" cols="30"
                                rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <label for="featured_image">Featured Image</label> <label for=""
                                    class="arabic red">صورة مميزة</label>
                            </div>

                            <div class="form-group px-0 col-12">

                                {{-- <input type="file" class="custom-file-input" id="featured_image"
                                    name="featured_image" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="featured_image">Choose file</label> --}}
                                <div class="input-group mb-3 choseFileInputs">
                                    <input type="file" class="form-control chooser" name="featured_image" id="featured_image">
                                    <label class="input-group-text bg-danger text-white" for="featured_image">Browse</label>
                                    </div>
                            </div>
                        </div>
                        {{--  <div class="col-6">
                            <div class="d-flex justify-content-between">
                                <label for="files">Upload Files</label> <label for=""
                                    class="arabic red">تحميل الملفات</label>
                            </div>

                            <div class="form-group col-12">

                                <input type="file" class="custom-file-input" id="files" name="files[]"
                                    multiple aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="files">Choose file</label>
                            </div>
                        </div>  --}}


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="editRequestBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
