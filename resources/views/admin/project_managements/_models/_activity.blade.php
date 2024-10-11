<!-- Modal -->
<div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 160%">
            <div class="modal-header bg-danger">
                <div class="d-flex">
                    <h5 class="modal-title text-white" id="activityModalLabel">Activity &nbsp; / &nbsp;</h5>
                    <h5 class="modal-title text-white arabic" id="activityModalLabel">نشاط </h5>
                </div>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="activityAddForm" action="{{ route('activity.store') }}" method="POST">
                    <input type="hidden" name="task_id" id="task_id" value="{{ $task->id }}">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="d-flex justify-content-between">
                                <label for="name">Name</label>
                                <label class="arabic red" for="name">اسم</label>
                            </div>

                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="location_id">Location</label>
                                <label class="arabic red" for="location_id">موقع</label>
                            </div>

                            <select id="location_id" name="location_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="date">Date</label>
                                <label class="arabic red" for="date">تاريخ</label>
                            </div>

                            <input type="date" id="date" name="date" class="form-control" id="projectDate">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="latitude">Latitude</label>
                                <label class="arabic red" for="latitude">خط العرض</label>
                            </div>

                            <input type="number" name="latitude" class="form-control" id="latitude">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="longitude">Longitude</label>
                                <label class="arabic red" for="longitude">خط الطول</label>
                            </div>

                            <input type="number" name="longitude" class="form-control" id="longitude">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="description">Notes</label>
                            <textarea name="description" type="text" class="form-control" id="description" cols="30" rows="2"></textarea>
                        </div>
                        <div class="form-group col-6 text-right">
                            <label for="description_arabic" class="arabic red">ملحوظات</label>
                            <textarea name="description_arabic" type="text" class="form-control text-right" id="description_arabic"
                                cols="30" rows="2"></textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="d-flex justify-content-between">
                            <label for="files">Upload Images &nbsp; / &nbsp;</label>
                            <label class="arabic red" for="files">تحميل الصور</label>
                        </div>

                        <div class="form-group col-12">

                            <input type="file" class="custom-file-input" id="files" name="files[]" multiple
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="activityAddBtn">
                    <p>Save &nbsp;/&nbsp;</p>
                    <p class="arabic">يحفظ</p>
                </button>
            </div>
        </div>
    </div>
</div>
