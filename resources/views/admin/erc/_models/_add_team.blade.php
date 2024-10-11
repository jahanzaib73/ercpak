<!-- Modal -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="projectModalLabel">Create Team &nbsp; / &nbsp;
                    </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إنشاء فريق</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                {{-- <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Vendor</strong></h3> --}}
                <h5 class="modal-title modal-heading text-black" id="projectModalLabel">Create Team &nbsp; / &nbsp;
                </h5>
                <h5 class="modal-title modal-heading text-blackarabic" id="projectModalLabel">إنشاء فريق</h5>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="team_add_form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_name">Team Name</label>
                                <label for="team_name" class="arabic red"> اسم الفريق</label>
                            </div>
                            <input type="text" class="form-control" name="team_name" id="team_name">
                        </div>

                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_name_urdu">Team Name In Arabic</label>
                                <label for="team_name_urdu" class="arabic red">اسم الفريق باللغة العربية</label>
                            </div>
                            <input type="text" class="form-control" name="team_name_urdu" id="team_name_urdu">
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_city">City</label>
                                <label for="team_city" class="arabic red">مدينة</label>
                            </div>

                            <select id="team_city" name="team_city" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_country">Country</label>
                                <label for="team_country" class="arabic red">دولة</label>
                            </div>
                            <select id="team_country" name="team_country" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_color">Team Color</label>
                                <label for="team_color" class="arabic red"> لون الفريق </label>
                            </div>
                            <input type="color" class="form-control p-3 mt-1" name="team_color" id="team_color">
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-between">
                                <label for="file">Upload Symbol of Team</label>
                                <label for="file" class="arabic red">تحميل رمز الفريق </label>
                            </div>
                            <div class="form-group col-12">
                                {{-- <input type="file" class="custom-file-input" id="team_symbol" name="file"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label> --}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                   </div>
                                   <div class="input-group mb-3 choseFileInputs">
                                   <input type="file" class="form-control chooser" name="team_symbol" id="team_symbol">
                                   <label class="input-group-text bg-danger text-white" for="team_symbol">Browse</label>
                                   </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if (Auth::user()->can('View Team'))
                    <a href="{{ route('teams.index') }}" id="btn-possition" class="btn save-btn d-flex">
                        <p>View list &nbsp;/&nbsp;</p>
                        <p class="arabic">يغلق</p>
                    </a>
                @endif
                <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="submitFormButtonTeam">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
