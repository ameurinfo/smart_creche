@extends('layout-app.base')
<link rel="stylesheet" type="text/css" href="{{asset('backend/dist/css/main.css')}}" media="screen">
@section('content')
<div class="row">
<div class="col-12">
    <div id="videos">
        <video class="video-player" id="user-1" autoplay playinline></video>
        <video class="video-player" id="user-2" autoplay playinline></video>
    </div>
    <div id="controls">
        <div class="control-container" id="camera-btn">
            <img src="{{asset('backend/dist/img/camera.png')}}" />
        </div>

        <div class="control-container" id="mic-btn">
            <img src="{{asset('backend/dist/img/mic.png')}}" />
        </div>
        <a href="{{route('children.index')}}">
        <div class="control-container" id="leave-btn">
            <img src="{{asset('backend/dist/img/phone.png')}}" />
        </div>
        </a>
    </div>
</div>

</div>
@endsection
@section('footer')
<script src="{{asset('backend/dist/js/agora-rtm-sdk-1.4.4.js')}}"></script>
<script src="{{asset('backend/dist/js/main.js')}}"></script>
@endsection
