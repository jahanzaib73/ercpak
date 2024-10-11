  <!-- Modal -->
  <div class="modal fade" id="projectStart" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-danger">
                  <div class="d-flex justify-content-between">
                      <h5 class="modal-title text-white" id="projectModalLabel">Start Project &nbsp; / &nbsp;</h5>
                      <h5 class="modal-title text-white arabic" id="projectModalLabel">ابدأ المشروع</h5>
                  </div>

                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="startProjectForm" method="post" action="{{ route('projects.start') }}">
                      <input type="hidden" name="ProjectTaskId" id="ProjectTaskId">
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <div class="d-flex justify-content-between">
                                  <label>Task Number :</label> <label class="arabic red"> رقم المهمة</label>
                              </div>
                              <h6 id="task_number_id"></h6>
                          </div>

                          <div class="form-group col-md-6">
                              <div class="d-flex justify-content-between">
                                  <label>Task Name :</label> <label class="arabic red"> اسم المهمة</label>
                              </div>
                              <h6 id="task_name_id"></h6>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-4">
                              <div class="d-flex justify-content-between">
                                  <label for="date">Date</label> <label for="inputyear"
                                      class="arabic red">تاريخ</label>
                              </div>
                              <input type="date" class="form-control" id="date" name="date">
                          </div>
                          <div class="form-group col-md-4">
                              <div class="d-flex justify-content-between">
                                  <label for="latitude">latitude</label> <label class="arabic red"> خط العرض
                                  </label>
                              </div>
                              <input type="number" class="form-control" id="latitude" name="latitude">
                          </div>
                          <div class="form-group col-md-4">
                              <div class="d-flex justify-content-between">
                                  <label for="longitude">Longitude</label> <label class="arabic red"> خط الطول
                                  </label>
                              </div>
                              <input type="number" class="form-control" id="longitude" name="longitude">
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-6">
                              <label for="start_description">Task Description</label>
                              <textarea name="start_description" type="text" class="form-control" id="start_description" cols="30"
                                  rows="2"></textarea>
                          </div>
                          <div class="form-group col-6 text-right">
                              <label for="start_description_arabic" class="arabic red">وصف المهمة </label>
                              <textarea name="start_description_arabic" type="text" class="form-control text-right" id="start_description_arabic"
                                  cols="30" rows="2"></textarea>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="d-flex justify-content-between">
                              <label for="files">Upload Files &nbsp; / &nbsp;</label> <label for=""
                                  class="arabic red">تحميل
                                  الملفات</label>
                          </div>
                          <div class="form-group col-12">

                              <input type="file" class="custom-file-input" id="files" name="files[]" multiple
                                  aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="files">Choose file</label>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                      <p>Close &nbsp;/&nbsp;</p>
                      <p class="arabic">يغلق</p>
                  </button>
                  <button type="button" class="btn save-btn d-flex" id="startProjectBtn">
                      <p>Save &nbsp;/&nbsp;</p>
                      <p class="arabic">يحفظ</p>
                  </button>
              </div>
          </div>
      </div>
  </div>
