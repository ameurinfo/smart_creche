@extends('layout-app.base')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>تفاصيل السجلات التراكمية: {{$student->name}}</h5>
        </div>
        <div class="card-body">
            @foreach($student->cumulativeRecords as $record)
                <ul class="nav nav-tabs" id="myTab-{{ $record->id }}" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="child-data-tab-{{ $record->id }}" data-toggle="tab" href="#child-data-{{ $record->id }}" role="tab" aria-controls="child-data-{{ $record->id }}" aria-selected="true">بيانات الطفل</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="family-data-tab-{{ $record->id }}" data-toggle="tab" href="#family-data-{{ $record->id }}" role="tab" aria-controls="family-data-{{ $record->id }}" aria-selected="false">بيانات الأسرة</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="health-data-tab-{{ $record->id }}" data-toggle="tab" href="#health-data-{{ $record->id }}" role="tab" aria-controls="health-data-{{ $record->id }}" aria-selected="false">بيانات الصحية</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="mental-data-tab-{{ $record->id }}" data-toggle="tab" href="#mental-data-{{ $record->id }}" role="tab" aria-controls="mental-data-{{ $record->id }}" aria-selected="false">بيانات القدرات العقلية</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="cognitive-data-tab-{{ $record->id }}" data-toggle="tab" href="#cognitive-data-{{ $record->id }}" role="tab" aria-controls="cognitive-data-{{ $record->id }}" aria-selected="false">بيانات الجانب المعرفي</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="independence-data-tab-{{ $record->id }}" data-toggle="tab" href="#independence-data-{{ $record->id }}" role="tab" aria-controls="independence-data-{{ $record->id }}" aria-selected="false">الاستقلالية</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="activities-data-tab-{{ $record->id }}" data-toggle="tab" href="#activities-data-{{ $record->id }}" role="tab" aria-controls="activities-data-{{ $record->id }}" aria-selected="false">النشاطات</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="emotional-data-tab-{{ $record->id }}" data-toggle="tab" href="#emotional-data-{{ $record->id }}" role="tab" aria-controls="emotional-data-{{ $record->id }}" aria-selected="false">الجانب الانفعالي</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent-{{ $record->id }}">
                    <div class="tab-pane fade show active" id="child-data-{{ $record->id }}" role="tabpanel" aria-labelledby="child-data-tab-{{ $record->id }}">
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>العمر الزمني:</strong> {{ $record->age }}</li>
                            <li class="list-group-item"><strong>العمر العقلي:</strong> {{ $record->mental_age }}</li>
                            <li class="list-group-item"><strong>نوع الإعاقة:</strong> {{ $record->disability }}</li>
                            <li class="list-group-item"><strong>تاريخ التسجيل:</strong> {{ $record->created_at->format('Y-m-d H:i:s') }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="family-data-{{ $record->id }}" role="tabpanel" aria-labelledby="family-data-tab-{{ $record->id }}">
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>عدد أفراد الأسرة:</strong> {{ $record->family_members }}</li>
                            <li class="list-group-item"><strong>عدد الأخوة:</strong> {{ $record->siblings }}</li>
                            <li class="list-group-item"><strong>الولي:</strong> {{ $record->guardian }}</li>
                            <li class="list-group-item"><strong>ترتيب الطفل في العائلة:</strong> {{ $record->child_order }}</li>
                            <li class="list-group-item"><strong>مع من يعيش الطفل:</strong> {{ $record->living_with }}</li>
                            <li class="list-group-item"><strong>الحالة الاقتصادية:</strong> {{ $record->economic_status }}</li>
                            <li class="list-group-item"><strong>أجواء المنزل:</strong> {{ $record->home_status }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="health-data-{{ $record->id }}" role="tabpanel" aria-labelledby="health-data-tab-{{ $record->id }}">
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>السمع:</strong> {{ $record->hearing }}</li>
                            <li class="list-group-item"><strong>البصر:</strong> {{ $record->vision }}</li>
                            <li class="list-group-item"><strong>الذوق:</strong> {{ $record->taste }}</li>
                            <li class="list-group-item"><strong>اللمس:</strong> {{ $record->touch }}</li>
                            <li class="list-group-item"><strong>النطق:</strong> {{ $record->speech }}</li>
                            <li class="list-group-item"><strong>مصاب بمرض مزمن:</strong> {{ $record->chronic_disease }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="mental-data-{{ $record->id }}" role="tabpanel" aria-labelledby="mental-data-tab-{{ $record->id }}">
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>اختبارات الذكاء:</strong> {{ $record->intelligence_tests }}</li>
                            <li class="list-group-item"><strong>القدرات الخاصة:</strong> {{ $record->special_abilities }}</li>
                            <li class="list-group-item"><strong>تاريخ اجرائها وتقرير النفسانيين:</strong> {{ $record->psychological_tests }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="cognitive-data-{{ $record->id }}" role="tabpanel" aria-labelledby="cognitive-data-tab-{{ $record->id }}">
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>الادراك:</strong> {{ $record->cognitive }}</li>
                            <li class="list-group-item"><strong>اللانتباه والتركيز:</strong> {{ $record->attention_concentration }}</li>
                            <li class="list-group-item"><strong>الذاكرة:</strong> {{ $record->memory }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="independence-data-{{ $record->id }}" role="tabpanel" aria-labelledby="independence-data-tab-{{ $record->id }}">
                       
                        <ul class="list-group">
                            <li class="list-group-item"><strong>الأكل:</strong> {{ $record->eating }}</li>
                            <li class="list-group-item"><strong>النظافة:</strong> {{ $record->cleanliness }}</li>
                            <li class="list-group-item"><strong>اللباس:</strong> {{ $record->dressing }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="activities-data-{{ $record->id }}" role="tabpanel" aria-labelledby="activities-data-tab-{{ $record->id }}">
                       
                        <ul class="list-group">
                            <li class="list-group-item"><strong>الجانب النفسي الحركي:</strong> {{ $record->activities }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="emotional-data-{{ $record->id }}" role="tabpanel" aria-labelledby="emotional-data-tab-{{ $record->id }}">
                        
                        <ul class="list-group">
                            <li class="list-group-item"><strong>شديد الانفعال:</strong> {{ $record->highly_emotional }}</li>
                            <li class="list-group-item"><strong>منطوي:</strong> {{ $record->introverted }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection