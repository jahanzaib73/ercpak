  <!-- Modal -->
  <div class="modal fade" id="taskPercentage" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-danger">
                  <div class="d-flex justify-content-between">
                      <h5 class="modal-title text-white" id="projectModalLabel">Add Task Percentage &nbsp; / &nbsp;</h5>
                      <h5 class="modal-title text-white arabic" id="projectModalLabel">ابدأ المشروع</h5>
                  </div>

                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="taskPercentageForm" method="post" action="{{ route('task.store.percentage') }}">
                      <input type="hidden" name="ProjectTaskIdPerecntage" id="ProjectTaskIdPerecntage">

                      <div class="form-row">
                          <div class="form-group col-md-12">
                              <div class="d-flex justify-content-between">
                                  <label for="task_percentage">Percentage</label> <label for="inputyear"
                                      class="arabic red">نسبة مئوية</label>
                              </div>
                              <input type="number" class="form-control" id="task_percentage" name="task_percentage">
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                      <p>Close &nbsp;/&nbsp;</p>
                      <p class="arabic">يغلق</p>
                  </button>
                  <button type="button" class="btn save-btn d-flex" id="taskPercentageBtn">
                      <p>Save &nbsp;/&nbsp;</p>
                      <p class="arabic">يحفظ</p>
                  </button>
              </div>
          </div>
      </div>
  </div>
