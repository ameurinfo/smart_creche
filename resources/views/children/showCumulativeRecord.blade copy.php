@extends('layout-app.base')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5> تفاصيل السجل التراكمي: {{$student->name}}</h5>
        </div>
        <div class="card-body">
            @foreach($student->cumulativeRecords as $cumulativeRecord)
            <div class="row">
                <div class="col-md-6">
                    <h4>بيانات الطفل</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>العمر الزمني:</strong> {{ $cumulativeRecord->age }}</li>
                        <li class="list-group-item"><strong>العمر العقلي:</strong> {{ $cumulativeRecord->mental_age }}</li>
                        <li class="list-group-item"><strong>نوع الإعاقة:</strong> {{ $cumulativeRecord->disability }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>بيانات القدرات العقلية</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>اختبارات الذكاء:</strong> {{ $cumulativeRecord->intelligence_tests }}</li>
                        <li class="list-group-item"><strong>القدرات الخاصة:</strong> {{ $cumulativeRecord->special_abilities }}</li>
                        <li class="list-group-item"><strong>تاريخ اجرائها وتقرير النفسانيين:</strong> {{ $cumulativeRecord->psychological_tests }}</li>
                    </ul>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4>بيانات الطفل الصحية</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>السمع:</strong> {{ $cumulativeRecord->hearing }}</li>
                        <li class="list-group-item"><strong>البصر:</strong> {{ $cumulativeRecord->vision }}</li>
                        <li class="list-group-item"><strong>الذوق:</strong> {{ $cumulativeRecord->taste }}</li>
                        <li class="list-group-item"><strong>اللمس:</strong> {{ $cumulativeRecord->touch }}</li>
                        <li class="list-group-item"><strong>النطق:</strong> {{ $cumulativeRecord->speech }}</li>
                        <li class="list-group-item"><strong>مصاب بمرض مزمن:</strong> {{ $cumulativeRecord->chronic_disease }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>بيانات الأسرة</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>عدد أفراد الأسرة:</strong> {{ $cumulativeRecord->family_members }}</li>
                        <li class="list-group-item"><strong>عدد الأخوة:</strong> {{ $cumulativeRecord->siblings }}</li>
                        <li class="list-group-item"><strong>الولي:</strong> {{ $cumulativeRecord->guardian }}</li>
                        <li class="list-group-item"><strong>ترتيب الطفل في العائلة:</strong> {{ $cumulativeRecord->child_order }}</li>
                        <li class="list-group-item"><strong>مع من يعيش الطفل:</strong> {{ $cumulativeRecord->living_with }}</li>
                        <li class="list-group-item"><strong>الحالة الاقتصادية:</strong> {{ $cumulativeRecord->economic_status }}</li>
                        <li class="list-group-item"><strong>أجواء المنزل:</strong> {{ $cumulativeRecord->home_status }}</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4>بيانات الجانب المعرفي</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>الادراك:</strong> {{ $cumulativeRecord->cognitive }}</li>
                        <li class="list-group-item"><strong>اللانتباه والتركيز:</strong> {{ $cumulativeRecord->attention_concentration }}</li>
                        <li class="list-group-item"><strong>الذاكرة:</strong> {{ $cumulativeRecord->memory }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>الاستقلالية</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>الأكل:</strong> {{ $cumulativeRecord->eating }}</li>
                        <li class="list-group-item"><strong>النظافة:</strong> {{ $cumulativeRecord->cleanliness }}</li>
                        <li class="list-group-item"><strong>اللباس:</strong> {{ $cumulativeRecord->dressing }}</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4>النشاطات</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>الجانب النفسي الحركي:</strong> {{ $cumulativeRecord->activities }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>الجانب الانفعالي</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>شديد الانفعال:</strong> {{ $cumulativeRecord->highly_emotional }}</li>
                        <li class="list-group-item"><strong>منطوي:</strong> {{ $cumulativeRecord->introverted }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection