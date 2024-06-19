@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تعديل بيانات المستخدم</h2>
            <div class="float-end">
                <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
            </div>
        </div>
    </div>
</div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header">
                    <h5>تفاصيل بيانات المستخدم</h5>
                </div>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"><strong>الاسم الكامل:</strong></label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>الايميل:</strong></label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password"><strong>كلمة المرور:</strong></label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password"><strong>تأكيد كلمة المرور:</strong></label>
                            <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label for="roles"><strong>المهام:</strong></label>
                            <select class="form-control" multiple name="roles[]">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ in_array($role, $user->getRoleNames()->toArray()) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
