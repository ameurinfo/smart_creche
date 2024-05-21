@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">إدارة الموظفين</h3>
                    <div class="card-tools">
                        <a href="{{ route('staff.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة موظف جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($staff->isEmpty())
                        <p>لا توجد سجلات للموظفين.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الوظيفة</th>
                                    <th>تاريخ التوظيف</th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->job_title }}</td>
                                        <td>{{ $member->hire_date }}</td>
                                        <td>
                                            <a href="{{ route('staff.show', $member->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> عرض</a>
                                            <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> تعديل</a>
                                            <form action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
