<div class="modal fade" id="allAttachment" aria-labelledby="tripLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 150%">
            <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="tripLabel">Attachments</h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <table class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Attachment</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fuel->attachments as $attchment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ $attchment->file_url }}" target="_blank"><i class="fa fa-file"></i></a>
                                </td>
                                <td>{{ $attchment->type }}</td>
                                <td>
                                    <a href="" class="btn bg-info btn-sm edit text-white"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Attachment</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>
