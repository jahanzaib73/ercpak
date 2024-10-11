<!-- Modal -->
<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="projectModalLabel">Edit Team &nbsp; / &nbsp;
                    </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إنشاء فريق</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="team_edit_form" action="{{ route('teams.update') }}" method="POST">
                    <input type="hidden" name="team_id" id="edit_team_id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_name">Team Name</label>
                                <label for="team_name" class="arabic red"> اسم الفريق</label>
                            </div>
                            <input type="text" class="form-control" name="team_name" id="edit_team_name">
                        </div>

                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_name_urdu">Team Name In Arabic</label>
                                <label for="team_name_urdu" class="arabic red">اسم الفريق باللغة العربية</label>
                            </div>
                            <input type="text" class="form-control" name="team_name_urdu" id="edit_team_name_urdu">
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_city">City</label>
                                <label for="team_city" class="arabic red">مدينة</label>
                            </div>

                            <select id="edit_team_city" name="team_city" class="form-control">
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
                            <select id="edit_team_country" name="team_country" class="form-control">
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
                            <input type="color" class="form-control" name="team_color" id="edit_team_color">
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-between">
                                <label for="file">Upload Symbol of Team</label>
                                <label for="file" class="arabic red">تحميل رمز الفريق </label>
                            </div>
                            <div class="form-group col-12">
                                <input type="file" class="custom-file-input" id="edit_team_symbol" name="file"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_color">Team Status</label>
                                <label for="team_color" class="arabic red"> حالة الفريق </label>
                            </div>
                            <select id="edit_team_status" name="team_status" class="form-control">
                                <option value="">Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">In-active</option>

                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn btn-danger d-flex" id="submitFormButtonTeamEdit">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
