@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تسيير المهام</h2>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('roles.create') }}">إضافة مهمة</a>
            </div>
        </div>
    </div>
</div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>قائمة المهام</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>المهام</th>
                        <th width="280px">اﻷمر</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">تفاصيل</a>
                                    @can('role-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                    @endcan
                                    @csrf
                                    @method('DELETE')
                                    @can('role-delete')
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $roles->links() !!}
        </div>
    </div>
@endsection
