@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>عرض بيانات المستخدم</h2>
            <div class="float-end">
                <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header">
                <h5>تفاصيل بيانات المستخدم</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <strong>الاسم الكامل :</strong>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="form-group">
                    <strong>الايميل:</strong>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="form-group">
                    <strong>المهام :</strong>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-secondary text-dark">{{ $v }}</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
