<!-- Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 190%; left: -90px;">
            {{-- <div class="modal-header bg-danger d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title text-white" id="memberModalLabel">Assign Area &nbsp; / &nbsp; </h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">تخصيص المنطقة </h5>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}

            <div class="modal-header bottom-border p-1">
                {{-- <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Vendor</strong></h3> --}}
                <h5 class="modal-title modal-heading text-black" id="memberModalLabel">Assign Area &nbsp; / &nbsp; </h5>
                <h5 class="modal-title modal-heading text-black arabic" id="projectModalLabel">تخصيص المنطقة </h5>
               
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <form id="assignAreaForm">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="area_id">Choose Area</label> <label for="area_id"
                                            class="arabic red">اختر المنطقة </label>
                                    </div>
                                    <select id="area_id" name="area_id" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($areas as $area)
                                            <option data-polygon="{{ $area->polygon_coordinates }}"
                                                value="{{ $area->id }}">{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="team_id">Select Team</label>
                                        <label for="team_id" class="arabic red">اختر فريق</label>
                                    </div>

                                    <select id="team_id_assign" class="form-control" name="team_id">
                                        <option value="">Choose...</option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="member_id">Select Member</label> <label for="member_id"
                                            class="arabic red">اختر عضوا </label>
                                    </div>
                                    <select id="member_id" name="member_id" class="form-control">
                                        <option value="">Choose...</option>
                                        {{--  @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->member_name }}</option>
                                        @endforeach  --}}
                                    </select>
                                </div>

                                <div class="form-group  col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="year">Year / Season</label> <label for="year"
                                            class="arabic red">
                                            السنة / الموسم </label>
                                    </div>
                                    <input type="year" class="form-control" id="year" name="year">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-8">
                        <div id="mapAssignArea"
                            style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="assignAreaBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
