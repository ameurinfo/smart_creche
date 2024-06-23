@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تفاصيل تعديل السلوك : {{$student->name}}</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success my-2">
    <p>{{ $message }}</p>
</div>
@endif

@if ($behaviorModification)
<div class="card">
    <div class="card-header">
        <h5>السلوك غير السوي</h5>
    </div>
    <div class="card-body">
        @php
        $behaviorsList = ['الخوف', 'السلوك العدواني', 'التغذية', 'النوم', 'التبول اللاإرادي', 'الغيرة'];
        @endphp

        @foreach($behaviorModification->behaviors as $index => $behavior)
        <div class="form-group">
            <label for="behavior{{ $index + 1 }}">{{ $behaviorsList[$index] }}</label>
            <p>{{ $behavior }}</p>
        </div>
        @endforeach
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>نقاط الاستحسان</h5>
    </div>
    <div class="card-body">
        <div class="form-group mt-4">
            <label><strong>نقاط التقييم:</strong></label>
            <div class="rating-container">
                @for ($i = 0; $i <= 9; $i++)
                <span class="star {{ $i <= $behaviorModification->overall_rating ? 'selected' : '' }}">&#9733;</span>
                @endfor
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    <p>لا توجد بيانات تعديل السلوك متاحة.</p>
</div>
@endif

@endsection

@section('footer')
<style>
    .star {
        font-size: 24px; /* Increase the size of the stars */
    }
    .star.selected {
        color: gold;
    }
</style>
@endsection