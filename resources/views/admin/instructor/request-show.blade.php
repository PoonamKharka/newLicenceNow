<div class="container p-3">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Instructor Details</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $instructor->first_name }} {{ $instructor->last_name }}</p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $instructor->email }}">{{ $instructor->email }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong> <a href="tel:{{ $instructor->phoneNo }}">{{ $instructor->phoneNo }}</a>
                    </p>
                    <p><strong>Post Code:</strong> {{ $instructor->postcode }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Status:</strong>
                        <span
                            class="p-2 badge badge-{{ $instructor->status == 'approve' ? 'success' : ($instructor->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($instructor->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Attachments</h5>
        </div>
        <div class="card-body">
            @if ($instructor->mediaAttachments->isEmpty())
                <p class="text-muted">No media attachments available.</p>
            @else
                <div class="row">
                    @foreach ($instructor->mediaAttachments as $attachment)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    @if (in_array($attachment->file_type, ['image/jpeg', 'image/png', 'image/gif']))
                                        <img src="{{ $attachment->file_path }}" alt="Attachment"
                                            class="img-fluid img-thumbnail mb-2" style="max-height: 150px;">
                                    @else
                                        <a href="{{ $attachment->file_path }}" target="_blank"
                                            class="btn btn-outline-info">{{ $attachment->file_name }}</a>
                                    @endif
                                    <div class="mt-2">
                                        <select class="form-control attachment-status"
                                            data-attachment-id="{{ $attachment->id }}">
                                            <option value="approve"
                                                {{ $attachment->file_status == 'approve' ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="pending"
                                                {{ $attachment->file_status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="rejected"
                                                {{ $attachment->file_status == 'rejected' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
                                        <p class="attachment-msg-{{ $attachment->id }} mt-2"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


<script>
    $(document).on('change', '.attachment-status', function() {


        let attachmentId = $(this).attr('data-attachment-id');
        let attachmentStatus = $(this).val();

        // Send AJAX request to update statuses
        $.ajax({
            url: "/admin/update-attachments/" + attachmentId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                media_attachment_status: attachmentStatus
            },
            success: function(response) {
                toastr.success(response.message, 'Success', {
                    timeOut: 5000
                });
            },
            error: function(response) {
                toastr.error('Unable to update status. Please try again later.', 'Error', {
                    timeOut: 5000
                });
            }
        });
    });
</script>
