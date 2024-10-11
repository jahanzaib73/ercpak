<!-- Modal -->
<div class="modal fade" id="createAreaModel" tabindex="-1" aria-labelledby="createAreaModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 190%; left: -90px;">
            {{-- <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="memberModalLabel">Create Area &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إنشاء منطقة</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                {{-- <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Vendor</strong></h3> --}}
                <h5 class="modal-title modal-heading text-black" id="memberModalLabel">Create Area&nbsp; / &nbsp; </h5>
                <h5 class="modal-title modal-heading text-black arabic" id="projectModalLabel">إنشاء منطقة</h5>
                
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="createAreaModelForm">
                            <input type="hidden" name="polygon" id="polygon">
                            <div class="form-row">
                                <div class="form-group  col-4">
                                    <div class="d-flex justify-content-between">
                                        <label for="area_name">Area Name</label> <label for="area_name"
                                            class="arabic red">
                                            اسم المنطقة </label>
                                    </div>
                                    <input type="text" name="area_name" class="form-control" id="area_name">
                                </div>
                                <div class="form-group col-4">
                                    <div class="d-flex justify-content-between">
                                        <label for="province_id">Province</label> <label for="province_id"
                                            class="arabic red">مقاطعة </label>
                                    </div>
                                    <select id="province_id" name="province_id" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <div class="d-flex justify-content-between">
                                        <label for="city_id">City</label> <label for="city_id"
                                            class="arabic red">مدينة </label>
                                    </div>
                                    <select id="city_id" name="city_id" class="form-control">
                                        <option value="">Choose...</option>
                                        {{--  @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach  --}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-12 px-0">
                                    <div class="d-flex justify-content-between">
                                        <label for="area_photoes">Upload Photos</label> <label for=""
                                            class="arabic red">حمل الصورة </label>
                                    </div>

                                    <div class="form-group px-0 col-12">
                                        {{-- 
                                        <input type="file" class="custom-file-input" id="area_photoes"
                                            name="area_photoes[]" aria-describedby="inputGroupFileAddon01" multiple>
                                        <label class="custom-file-label" for="area_photoes">Choose
                                            file</label> --}}

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                               
                                               </div>
                                                                                               
                                               <div class="input-group mb-3 choseFileInputs">
                                               <input type="file" class="form-control chooser" name="area_photoes" id="area_photoes">
                                               <label class="input-group-text bg-danger text-white" for="area_photoes">Browse</label>
                                               </div>
                                                </div>
                                            
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="mapCreateArea"
                            style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                @if (Auth::user()->can('View Area'))
                    <a href="{{ route('areas.index') }}" id="btn-possition" class="btn save-btn d-flex">
                        <p>View list &nbsp;/&nbsp;</p>
                        <p class="arabic">يغلق</p>
                    </a>
                @endif
                <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="createAreaModelBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
