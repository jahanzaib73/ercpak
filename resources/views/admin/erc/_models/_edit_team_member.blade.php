<!-- Modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="editMemberModal">Update Member &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إضافة عضو</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="team_member_edit_form" action="{{ route('teams.members.update') }}" method="POST">
                    <input type="hidden" name="member_id" id="edit_member_id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_member_name">Member Name</label>
                                <label for="team_member_name" class="arabic red"> اسم الفريق</label>
                            </div>
                            <input type="text" class="form-control" id="edit_team_member_name"
                                name="team_member_name">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_id">Select Team</label>
                                <label for="team_id" class="arabic red">اختر فريق</label>
                            </div>

                            <select id="edit_team_id" class="form-control" name="team_id">
                                <option value="">Choose...</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-6">
                            <div class="d-flex justify-content-between">
                                <label for="member_photo">Upload Photo</label> <label for=""
                                    class="arabic red">حمل الصورة </label>
                            </div>

                            <div class="form-group col-12">
                                <input type="file" class="custom-file-input" id="member_photo"
                                    aria-describedby="inputGroupFileAddon01" name="member_photo">
                                <label class="custom-file-label" for="member_photo">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn btn-danger d-flex" id="teamMemberEditBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="memberModalLabel">Add Member &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إضافة عضو</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="inputmember">Member Name</label> <label for="inputmember"
                                    class="arabic red">
                                    اسم الفريق</label>
                            </div>
                            <input type="text" class="form-control" id="inputmember">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="inputCurrency">Select Team</label> <label for="inputCurrency"
                                    class="arabic red">اختر فريق</label>
                            </div>

                            <select id="inputCurrency" class="form-control">
                                <option selected>Choose...</option>
                                <option>Team Name</option>
                                <option>Team Name</option>
                                <option>Team Name</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-6">
                            <div class="d-flex justify-content-between">
                                <label for="inputnotes">Upload Photo</label> <label for=""
                                    class="arabic red">حمل الصورة </label>
                            </div>

                            <div class="form-group col-12">

                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn btn-danger d-flex">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
