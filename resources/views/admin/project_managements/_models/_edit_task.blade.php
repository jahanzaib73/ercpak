  <!-- Modal -->
  <div class="modal fade" id="taskEdit" tabindex="-1" aria-labelledby="taskEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-danger">
                  <h5 class="modal-title text-white" id="taskEditLabel">Update Task</h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="taskEditForm" method="POST" action="{{ route('task.update') }}">

                      <div class="form-row">
                          <div class="form-group col-md-3">
                              <div class="d-flex justify-content-between">
                                  <label for="taskNumber">Task #</label> <label for="inputType" class="arabic red">رقم
                                      المهمة
                                  </label>
                              </div>

                              <input type="number" name="task_id" id="taskIdEdit" readonly class="form-control">
                          </div>
                          <div class="form-group col-md-3">
                              <div class="d-flex justify-content-between">
                                  <label for="task_name">Task Name</label> <label for="inputType" class="arabic red">اسم
                                      المهمة
                                  </label>
                              </div>

                              <input type="text" name="task_name" class="form-control" id="task_name_edit">
                          </div>
                          <div class="form-group col-md-3">
                              <div class="d-flex justify-content-between">
                                  <label for="task_type_id">Type of Task</label> <label for="task_type_id"
                                      class="arabic red">وصف المهمة
                                  </label>
                              </div>

                              <select id="task_type_id_edit" name="task_type_id" class="form-control">
                                  <option value="">Choose...</option>
                                  @foreach ($taskTypes as $type)
                                      <option value="{{ $type->id }}">{{ $type->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group col-md-3">
                              <div class="d-flex justify-content-between">
                                  <label for="location_id">Location</label> <label for="location_id"
                                      class="arabic red">موقع
                                  </label>
                              </div>

                              <select id="location_id_edit" name="location_id" class="form-control">
                                  <option value="">Choose...</option>
                                  @foreach ($locations as $location)
                                      <option value="{{ $location->id }}">{{ $location->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-row">

                          <div class="form-group col-md-4">
                              <div class="d-flex justify-content-between">
                                  <label for="task_date">Date</label> <label for="task_date"
                                      class="arabic red">تاريخ</label>
                              </div>
                              <input type="date" name="task_date" class="form-control" id="task_date_edit">
                          </div>
                          <div class="form-group col-md-4">
                              <div class="d-flex justify-content-between">
                                  <label for="amount">Amount</label> <label for="" class="arabic red">كمية
                                  </label>
                              </div>

                              <input type="number" name="amount" class="form-control" id="amountEdit"
                                  placeholder="0.00">
                          </div>
                          <div class="form-group col-md-4">
                              <div class="d-flex justify-content-between">
                                  <label for="currency_id">Currency</label> <label for=""
                                      class="arabic red">عملة</label>
                              </div>
                              <select id="currency_id_edit" name="currency_id" class="form-control">
                                  <option value="">Choose...</option>
                                  @foreach ($currencies as $currency)
                                      <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-12 col-md-6">
                              <label for="task_description">Task Description</label>
                              <textarea name="task_description" type="text" class="form-control" id="task_description_edit" cols="30"
                                  rows="2"></textarea>
                          </div>
                          <div class="form-group col-12 col-md-6 text-right">
                              <label for="task_description_arabic" class="arabic red">وصف المهمة </label>
                              <textarea name="task_description_arabic" type="text" class="form-control" id="task_description_arabic_edit"
                                  cols="30" rows="2"></textarea>
                          </div>
                      </div>
                      {{--  <div class="form-row">
                          <div class="form-group col-12 col-md-12">
                              <textarea name="task_description" type="text" class="form-control" id="task_description" cols="30"
                                  rows="2"></textarea>
                          </div>
                      </div>  --}}
                      <div class="form-row">
                          <div class="col-12 col-md-6">
                              <div class="d-flex justify-content-between">
                                  <label for="featured_image">Featured Image</label> <label for=""
                                      class="arabic red">صورة مميزة</label>
                              </div>

                              <div class="form-group px-0 col-12">

                                  {{-- <input type="file" class="custom-file-input" id="featured_image"
                                      name="featured_image" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="featured_image">Choose file</label> --}}
                                  <div class="input-group mb-3 choseFileInputs">
                                    <input type="file" class="form-control chooser" name="featured_image" id="featured_image">
                                    <label class="input-group-text bg-danger text-white" for="featured_image">Browse</label>
                                    </div>
                              </div>
                              <div class="d-flex justify-content-between">
                                  <label for="files">Upload Files</label> <label for=""
                                      class="arabic red">تحميل الملفات</label>
                              </div>

                              <div class="form-group col-12">

                                  {{-- <input type="file" class="custom-file-input" multiple id="files"
                                      name="files[]" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="files">Choose file</label> --}}
                                  <div class="input-group mb-3 choseFileInputs">
                                    <input type="file" class="form-control chooser" name="featured_image" id="featured_image">
                                    <label class="input-group-text bg-danger text-white" for="featured_image">Browse</label>
                                    </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-6">
                              <div class="d-flex justify-content-between">
                                  <label for="member_id">Add Members</label> <label for=""
                                      class="arabic red">إضافة أعضاء الفريق </label>
                              </div>

                              <div class="form-group col-12">
                                  <select name="member_id[]" id="member_id_edit" class="form-control" multiple>
                                      {{--  <option value="">Choose</option>  --}}
                                      @foreach ($users as $user)
                                          <option data-profile_pic_url="{{ $user->profile_pic_url }}"
                                              value="{{ $user->id }}">{{ $user->full_name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="row d-flex" id="memebr_image_container">
                                  {{--  <div class="col-6 col-md-3">
                                      <img src="{{ asset('img/emp2.png') }}" alt="" width="100%">
                                  </div>  --}}
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  {{--  <a href="{{ route('teams.index') }}" id="btn-possition" class="btn btn-secondary d-flex">
                      <p>View list &nbsp;/&nbsp;</p>
                      <p class="arabic">يغلق</p>
                  </a>  --}}
                  <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                      <p>Close &nbsp;/&nbsp;</p>
                      <p class="arabic">يغلق</p>
                  </button>
                  <button type="button" class="btn save-btn d-flex" id="taskEditButton">
                      <p>Update &nbsp;/&nbsp;</p>
                      <p class="arabic">تحديث</p>
                  </button>
              </div>
          </div>
      </div>
  </div>
