<div class="modal fade" id="allAttachment" tabindex="-1" aria-labelledby="tripLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h2 class="modal-title" id="tripLabel">Attachments</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Attachment</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trip->attachments as $attachment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ $attachment->file_url }}" target="_blank"><i class="fa fa-file"></i> View File</a></td>
                                <td>{{ $attachment->type }}</td>
                                <td>
                                    <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-primary btn-sm text-white">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
