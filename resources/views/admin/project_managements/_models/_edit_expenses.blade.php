<!-- Modal -->
<div class="modal fade" id="expenseEditModal" tabindex="-1" aria-labelledby="expenseEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <div class="d-flex justify-content-between">
                    <h5 class="modal-title text-white" id="projectModalLabel">Update Expense &nbsp; / &nbsp;</h5>
                    <h5 class="modal-title text-white arabic" id="projectModalLabel">أضف النفقات</h5>
                </div>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editExpenseForm" action="{{ route('expense.update') }}" method="POST">
                    <input type="hidden" name="id" id="expenseId">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="date">Date</label>
                                <label for="date" class="arabic red">تاريخ</label>
                            </div>

                            <input type="date" class="form-control" name="date" id="date_edit">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="bill_number">Bill #</label>
                                <label for="bill_number" class="arabic red">رقم الفاتوره</label>
                            </div>
                            <input type="text" class="form-control" id="bill_number_edit" name="bill_number">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="vendor_id">Vendor</label>
                                <label for="vendor_id" class="arabic red">بائع</label>
                            </div>

                            <select id="vendor_id_edit" name="vendor_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for="task_id">Task #</label>
                                <label for="task_id" class="arabic red">رقم المهمة</label>
                            </div>

                            <select id="task_id_edit" name="task_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach ($projectTasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->task_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <div class="d-flex justify-content-between">
                                <label for="amount">Amount</label>
                                <label for="amount" class="arabic red">كمية </label>
                            </div>

                            <input type="number" class="form-control" id="amount_edit" name="amount"
                                placeholder="0.00">
                        </div>
                        <div class="form-group col-md-5">
                            <div class="d-flex justify-content-between">
                                <label for="payment_status">Payment Status</label>
                                <label for="payment_status" class="arabic red">حالة السداد </label>
                            </div>

                            <select id="payment_status_edit" name="payment_status" class="form-control">
                                <option value="">Choose...</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Hold">Hold</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="description"> Description</label>
                            <textarea name="description" type="text" class="form-control" id="description_edit" cols="30" rows="2"></textarea>
                        </div>
                        <div class="form-group col-6 text-right">
                            <label for="description_arabic" class="arabic red">وصف </label>
                            <textarea name="description_arabic" type="text" class="form-control text-right" id="description_arabic_edit"
                                cols="30" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="d-flex justify-content-between">
                            <label for="files">Upload Files</label> &nbsp; / &nbsp; <label for=""
                                class="arabic red">تحميل
                                الملفات</label>
                        </div>
                        <div class="form-group col-12">

                            <input type="file" class="custom-file-input" id="files" name="files[]"
                                multiple="multiple" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="files">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{--  <a href="{{ route('teams.index') }}" id="btn-possition" class="btn btn-secondary d-flex">
                     <p>View list &nbsp;/&nbsp;</p>
                     <p class="arabic">يغلق</p>
                 </a>  --}}
                <button  type="button" class="btn save-btn d-flex" data-dismiss="modal">
                    <p>Close &nbsp;/&nbsp;</p>
                    <p class="arabic">يغلق</p>
                </button>
                <button type="button" class="btn save-btn d-flex" id="editExpenseBtn">
                    <p>Update &nbsp;/&nbsp;</p>
                    <p class="arabic">تحديث</p>
                </button>
            </div>
        </div>
    </div>
</div>
