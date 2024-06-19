@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>الإشعارات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="notifications-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>المحتوى</th>
                                <th>ملاحظات</th>
                                <th>التوقيت</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notifications as $notification)
                                <tr class="{{ $notification->read_at ? '' : 'table-secondary' }}">
                                    <td>{{ $notification->data['message'] ?? 'No message' }}</td>
                                    <td>{{ $notification->data['notes'] ?? 'No notes' }}</td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="mark-as-read">Mark as Read</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <p> لاتوجد إشعارات حاليا</p>
                                </tr>
                            @endforelse
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
@endsection

