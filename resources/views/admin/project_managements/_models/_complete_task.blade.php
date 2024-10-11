 <!-- Modal -->
 <div class="modal fade" id="projectCompleted" tabindex="-1" aria-labelledby="projectCompletedModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <div class="d-flex justify-content-between">
                     <h5 class="modal-title text-white" id="projectCompletedModalLabel">Complete Project &nbsp; / &nbsp;
                     </h5>
                     <h5 class="modal-title text-white arabic" id="projectModalLabel">مشروع كامل </h5>
                 </div>

                 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="completeProjectForm" method="POST" action="{{ route('projects.complete') }}">
                     <input type="hidden" name="ProjectTaskIdCompleted" id="ProjectTaskIdCompleted">
                     <div class="form-row">
                         <div class="form-group col-md-6">
                             <div class="d-flex justify-content-between">
                                 <label>Task Number :</label> <label class="arabic red"> رقم المهمة</label>
                             </div>
                             <h6 id="task_number_completed_id"></h6>
                         </div>

                         <div class="form-group col-md-6">
                             <div class="d-flex justify-content-between">
                                 <label>Task Name :</label> <label class="arabic red"> اسم المهمة</label>
                             </div>
                             <h6 id="task_name_completed_id"></h6>
                         </div>
                     </div>

                     <div class="form-row">
                         <div class="form-group col-md-12   ">
                             <div class="d-flex justify-content-between">
                                 <label for="completed_date">Date</label> <label for="inputyear"
                                     class="arabic red">تاريخ</label>
                             </div>
                             <input type="date" class="form-control" id="completed_date" name="completed_date">
                         </div>
                     </div>
                     <div class="form-row">
                         <div class="form-group col-6">
                             <label for="completed_description">Task Description</label>
                             <textarea name="completed_description" type="text" class="form-control" id="completed_description" cols="30"
                                 rows="2"></textarea>
                         </div>
                         <div class="form-group col-6 text-right">
                             <label for="completed_description_arabic" class="arabic red">وصف المهمة </label>
                             <textarea name="completed_description_arabic" type="text" class="form-control text-right"
                                 id="completed_description_arabic" cols="30" rows="2"></textarea>
                         </div>
                     </div>

                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                     <p>Close &nbsp;/&nbsp;</p>
                     <p class="arabic">يغلق</p>
                 </button>
                 <button type="button" class="btn save-btn d-flex" id="completeProjectBtn">
                     <p>Save &nbsp;/&nbsp;</p>
                     <p class="arabic">يحفظ</p>
                 </button>
             </div>
         </div>
     </div>
 </div>
