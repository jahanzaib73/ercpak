 <!-- Modal -->
 <div class="modal fade" id="projectEditModal" tabindex="-1" aria-labelledby="projectEditModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header bg-danger d-flex justify-content-between">
                 <div class="d-flex align-items-center">
                     <h5 class="modal-title text-white" id="projectEditModalLabel">Update Project &nbsp; / &nbsp; </h5>
                     <h5 class="modal-title text-white arabic" id="projectEditModalLabel">أضف المشروع</h5>
                 </div>
                 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="projectEditForm" action="{{ route('projects.update') }}" method="POST">
                     <input type="hidden" name="id" id="projectId">
                     <div class="form-row">
                         <div class="form-group col-md-4">
                             <div class="d-flex justify-content-between">
                                 <label for="inputProject#">Project #</label> <label for="inputProject#"
                                     class="arabic red">رقم
                                     المشروع</label>
                             </div>
                             <input readonly id="projectNumberEdit" type="text" class="form-control" id="projectName"
                                 placeholder="">
                         </div>
                         <div class="form-group col-md-4">
                             <div class="d-flex justify-content-between">
                                 <label for="project_name">Project Name</label> <label for="project_name"
                                     class="arabic red">اسم
                                     المشروع</label>
                             </div>

                             <input name="project_name" type="text" class="form-control" id="project_name_edit">
                         </div>
                         <div class="form-group col-md-4">
                             <div class="d-flex justify-content-between">
                                 <label for="task_type_id">Type of Task
                                     @if (Auth::user()->can('All Project Task Type'))
                                         <a href="{{ route('project-task-types.index') }}"><i
                                                 class="fa fa-plus"></i></a>
                                     @endif
                                 </label> <label for="task_type_id" class="arabic red">وصف المهمة
                                 </label>
                             </div>

                             <select id="task_type_id" name="task_type_id" class="form-control">
                                 <option value="">Choose...</option>
                                 @foreach ($taskTypes as $type)
                                     <option value="{{ $type->id }}">{{ $type->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="form-row">
                         <div class="form-group col-md-5">
                             <div class="d-flex justify-content-between">
                                 <label for="budget">Budget</label> <label for="budget"
                                     class="arabic red">ميزانية</label>
                             </div>

                             <input name="budget" type="number" class="form-control" id="budget_edit"
                                 placeholder="0.00">
                         </div>
                         <div class="form-group col-md-4">
                             <div class="d-flex justify-content-between">
                                 <label for="currency_id">Currency</label> <label for="currency_id"
                                     class="arabic red">عملة</label>
                             </div>

                             <select name="currency_id" id="currency_id_edit" class="form-control">
                                 <option value="">Choose...</option>
                                 @foreach ($currencies as $currency)
                                     <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="form-group col-md-3">
                             <div class="d-flex justify-content-between">
                                 <label for="project_date">Date</label> <label for="project_date"
                                     class="arabic red">تاريخ</label>
                             </div>
                             <input type="date" name="project_date" class="form-control" id="project_date_edit">
                         </div>
                     </div>
                     <div class="form-row">

                     </div>
                     <div class="form-row">
                         <div class="form-group col-6">
                             <label for="notes">Notes</label>
                             <textarea name="notes" type="text" class="form-control" id="notes_edit" cols="30" rows="2"></textarea>

                         </div>
                         <div class="form-group col-6 text-right">
                             <label for="notes_arabic" class="arabic red">ملحوظات</label>
                             <textarea name="notes_arabic" type="text" class="form-control" id="notes_arabic_edit" cols="30"
                                 rows="2"></textarea>

                         </div>
                         {{--  <div class="form-group col-12">
                             <textarea name="notes" type="text" class="form-control" id="projectnotes" cols="30" rows="2"></textarea>
                         </div>  --}}
                     </div>
                     <div class="form-row">
                         <div class="col-6">
                             <div class="d-flex justify-content-between">
                                 <label for="feature_image">Featured Image</label> <label for=""
                                     class="arabic red">صورة مميزة</label>
                             </div>

                             <div class="form-group px-0 col-12">

                                 {{-- <input type="file" name="feature_image" class="custom-file-input"
                                     id="feature_image" aria-describedby="inputGroupFileAddon01">
                                 <label class="custom-file-label" for="feature_image">Choose file</label> --}}

                                 <div class="input-group mb-3 choseFileInputs">
                                    <input type="file" class="form-control chooser" name="feature_image" id="feature_image">
                                    <label class="input-group-text bg-danger text-white" for="feature_image">Browse</label>
                                    </div>
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="d-flex justify-content-between">
                                 <label for="files">Upload Files</label> <label for=""
                                     class="arabic red">تحميل الملفات</label>
                             </div>

                             <div class="form-group col-12">

                                 {{-- <input type="file" name="files[]" multiple class="custom-file-input"
                                     id="files" aria-describedby="inputGroupFileAddon01">
                                 <label class="custom-file-label" for="files">Choose file</label> --}}
                                 <div class="input-group mb-3 choseFileInputs">
                                    <input type="file" class="form-control chooser" name="files[]" id="files[]">
                                    <label class="input-group-text bg-danger text-white" for="files[]">Browse</label>
                                    </div>
                             </div>
                         </div>
                     </div>

                 </form>
             </div>
             <div class="modal-footer">
                 {{--  <a href="{{ route('projects.index') }}" id="btn-possition" class="btn btn-secondary d-flex">
                     <p>View list &nbsp;/&nbsp;</p>
                     <p class="arabic">يغلق</p>
                 </a>  --}}
                 <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                     <p>Close &nbsp;/&nbsp;</p>
                     <p class="arabic">يغلق</p>
                 </type=>
                 <button type="button" id="projectEditBtn" class="btn save-btn d-flex">
                     <p>Update &nbsp;/&nbsp;</p>
                     <p class="arabic">تحديث</p>
                 </button>
             </div>
         </div>
     </div>
 </div>
