<!-- Modal -->
<div class="modal fade" id="updateAreaModel" tabindex="-1" aria-labelledby="updateAreaModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 190%; left: -90px;">
            <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="updateAreaModelLabel">Update Area &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إنشاء منطقة</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="updateAreaModelForm" action="{{ route('areas.update') }}" method="POST">
                            <input type="hidden" name="polygon" id="edit_polygon">
                            <input type="hidden" name="area_id" id="area_id">
                            <div class="form-row">
                                <div class="form-group  col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="area_name">Area Name</label> <label for="area_name"
                                            class="arabic red">
                                            اسم المنطقة </label>
                                    </div>
                                    <input type="text" name="area_name" class="form-control" id="edit_area_name">
                                </div>
                                <div class="form-group col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="province_id">Province</label> <label for="province_id"
                                            class="arabic red">مقاطعة </label>
                                    </div>
                                    <select id="edit_aera_province_id" name="province_id" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="city_id">City</label> <label for="city_id"
                                            class="arabic red">مدينة </label>
                                    </div>
                                    <select id="edit_city_id" name="city_id" class="form-control">
                                        <option value="">Choose...</option>
                                        {{--  @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach  --}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="area_photoes">Upload Photos</label> <label for=""
                                            class="arabic red">حمل الصورة </label>
                                    </div>

                                    <div class="form-group col-12">

                                        <input type="file" class="custom-file-input" id="edit_area_photoes"
                                            name="area_photoes[]" aria-describedby="inputGroupFileAddon01" multiple>
                                        <label class="custom-file-label" for="area_photoes">Choose
                                            file</label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row mb-5">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="status">Status</label>
                                        <label for="status" class="arabic red"> حالة الفريق </label>
                                    </div>
                                    <select id="edit_status" name="status" class="form-control">
                                        <option value="">Choose...</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-active</option>

                                    </select>
                                </div>

                            </div>


                        </form>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="mapEditArea" style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn btn-danger d-flex" id="updateAreaModelBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
