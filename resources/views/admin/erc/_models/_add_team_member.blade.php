<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="memberModalLabel">Add Member &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">إضافة عضو</h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                {{-- <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Vendor</strong></h3> --}}
                <h5 class="modal-title modal-heading text-black" id="memberModalLabel">Add Member &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title modal-heading text-blackarabic" id="projectModalLabel">إضافة عضو</h5>
                
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="team_member_add_form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_member_name">Member Name</label>
                                <label for="team_member_name" class="arabic red"> اسم الفريق</label>
                            </div>
                            <input type="text" class="form-control" id="team_member_name" name="team_member_name">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="team_id">Select Team</label>
                                <label for="team_id" class="arabic red">اختر فريق</label>
                            </div>

                            <select id="team_id" class="form-control" name="team_id">
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

                            <div class="form-group pl-0 col-12">

                                {{-- <input type="file" class="custom-file-input" id="member_photo"
                                    aria-describedby="inputGroupFileAddon01" name="member_photo">
                                <label class="custom-file-label" for="member_photo">Choose file</label> --}}
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
            <div class="modal-footer">
                @if (Auth::user()->can('View Member'))
                    <a href="{{ route('teams.members.index') }}" id="btn-possition" class="btn save-btn d-flex">
                        <p>View list &nbsp;/&nbsp;</p>
                        <p class="arabic">يغلق</p>
                    </a>
                @endif
                <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="teamMemberAddBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
