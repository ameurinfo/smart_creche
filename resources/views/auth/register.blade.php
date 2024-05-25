@extends('layouts.auth')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="{{ url('/') }}" class="h1"><b> Smart Creche</b></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">تسجيل عضو جديد</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="الاسم الكامل" value="{{ old('name') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="الايميل" value="{{ old('email') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="إعادة كلمة المرور" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">تسجيل</button>
                </div>
                <div class="col-8">
                    <div class="icheck-primary">
                        <label for="terms">
                            اوافق على <a href="#">شروط الخدمة</a>
                        </label>
                        <input type="checkbox" id="terms" name="terms">
                    </div>
                </div>
            </div>
        </form>

        <a href="{{ route('login') }}" class="text-center">لدي عضوية بالفعل</a>
    </div>
</div>
@endsection
