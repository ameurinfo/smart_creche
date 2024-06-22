@extends('layouts.auth')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header text-center">
        {{-- <a href="{{ url('/') }}" class="h1"><b> Smart Creche</b></a> --}}
        <a href="{{route('children.index')}}" class="brand-link">
            <img src="{{asset('backend/dist/img/smart_logo.png')}}" alt="SMART C Logo" style="width: 50%" 
                 style="opacity: .8">
          </a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">تسجيل الدخول لبدء جلسة العمل</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="الايميل" value="{{ old('email') }}" required autofocus>
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
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">دخول</button>
                </div>
                <div class="col-8 text-right">
                    <div class="icheck-primary">
                        <label for="remember">تذكرني</label>
                        <input type="checkbox" id="remember" name="remember">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
