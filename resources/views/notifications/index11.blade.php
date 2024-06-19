@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الإشعارات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="notifications-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>المحتوى</th>
                                <th>التوقيت</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->data['message'] ?? 'No message' }}</td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="#" class="view-notification" data-notification-id="{{ $notification->id }}" data-toggle="modal" data-target="#notificationModal">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $notifications->links() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">تفاصيل الإشعار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="notification-message"></p>
                <p id="notification-notes"></p>
                <small id="notification-time"></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="mark-as-read">Mark as Read</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
$(document).ready(function() {
    $('#notifications-table').DataTable({
        paging: false,
        info: false,
        searching: true,
        language: {
            "search": "Search:"
        }
    });

    let notificationId;

    $(document).on('click', '.view-notification', function(e) {
        e.preventDefault();
        notificationId = $(this).data('notification-id');
        $.ajax({
            url: '/notifications/' + notificationId,
            method: 'GET',
            success: function(response) {
                $('#notification-message').text(response.data.message || 'No message');
                $('#notification-notes').text(response.data.notes || 'No notes');
                $('#notification-time').text(response.created_at);
            },
            error: function(error) {
                console.error('Error fetching notification:', error);
            }
        });
    });

    $('#mark-as-read').click(function() {
        $.ajax({
            url: '/notifications/' + notificationId + '/mark-as-read',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#notificationModal').modal('hide');
                    $('tr').filter(function() {
                        return $(this).find('.view-notification').data('notification-id') == notificationId;
                    }).remove();
                } else {
                    console.error('Error marking notification as read:', response);
                }
            },
            error: function(error) {
                console.error('Error marking notification as read:', error);
            }
        });
    });
});
</script>
@endsection
