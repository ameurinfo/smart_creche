@extends('layout-app.base')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb mb-4">
      <div class="pull-left">
          <h2>إدارة المستخدمين</h2>
          <div class="float-end">
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">إضافة مستخدم</a>
          </div>
      </div>
  </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success my-2">
    <p>{{ $message }}</p>
</div>
@endif

<div class="card card-default">
    <div class="card-header">
        <h5>قائمة المستخدمين</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>الاسم الكامل</th>
                    <th>الايميل</th>
                    <th>المهام</th>
                    <th width="280px">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <span class="badge badge-secondary">{{ $v }}</span>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">تفاصيل</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">تعديل</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {!! $data->links() !!}
    </div>
</div>
@endsection
