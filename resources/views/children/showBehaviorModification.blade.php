@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تفاصيل تعديل السلوك</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success my-2">
  <p>{{ $message }}</p>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5>تفاصيل الطفل</h5>
    </div>
    <div class="card-body">
        <p><strong>اسم الطفل:</strong> {{ $child->name }}</p>
        <p><strong>تاريخ الولادة:</strong> {{ $child->date_of_birth }}</p>
        <p><strong>الجنس:</strong> {{ $child->gender }}</p>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>تعديل السلوك</h5>
    </div>
    <div class="card-body">
        <p><strong>الخوف:</strong> {{ $behaviorModification->fear }}</p>
        <p><strong>السلوك العدواني:</strong> {{ $behaviorModification->aggressive_behavior }}</p>
        <p><strong>التغذية:</strong> {{ $behaviorModification->feeding }}</p>
        <p><strong>النوم:</strong> {{ $behaviorModification->sleep }}</p>
        <p><strong>التبول اللاإرادي:</strong> {{ $behaviorModification->involuntary_urination }}</p>
        <p><strong>الغيرة:</strong> {{ $behaviorModification->jealousy }}</p>
        <p><strong>نقاط التقييم:</strong> {{ $behaviorModification->overall_rating }}</p>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('children.index') }}" class="btn btn-primary">العودة إلى القائمة</a>
</div>
@endsection