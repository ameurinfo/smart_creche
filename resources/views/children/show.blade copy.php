@extends('layout-app.base')

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $student->image ?? asset('backend/dist/img/user4-128x128.jpg') }}"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $student->name }}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>الرقم</b> <a class="float-right">{{ $student->id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>تاريخ الميلاد</b> <a class="float-right">{{ $student->birthdate }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>الجنس</b> <a class="float-right">{{ $student->gender }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#base_info" data-toggle="tab">المعلومات اﻷساسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact_info" data-toggle="tab">معلومات الاتصال</a></li>
                    <li class="nav-item"><a class="nav-link" href="#educational_follow_up" data-toggle="tab">المتابعة التربوية</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="base_info">
    
                            <dl>
                                <dt>الاسم الكامل</dt>
                                <dd>{{ $student->name }}</dd>
        
                                <dt>تاريخ الميلاد</dt>
                                <dd>{{ $student->birthdate }}</dd>
        
                                <dt>الجنس</dt>
                                <dd>{{ $student->gender }}</dd>
        
                                <dt>اسم ولي اﻷمر</dt>
                                <dd>{{ $student->parents->name }}</dd>

                                <dt>ملاحظات</dt>
                                <dd>{{ $student->notes }}</dd>
                            </dl>
                        </div>
                        <div class="tab-pane" id="contact_info">
                    <dl>
                        <dt>العنوان</dt>
                        <dd>{{ $student->address }}</dd>

                        <dt>رقم الهاتف</dt>
                        <dd>{{ $student->phone_number }}</dd>

                        <dt>الايميل</dt>
                        <dd>{{ $student->email }}</dd>


                    </dl>
                        </div>
                        <div class="tab-pane" id="educational_follow_up">
                            @foreach ($student->educational_follow_up as $item)

                                <div class="timeline timeline-inverse">
                                
                                <div class="time-label">
                                <span class="bg-danger">
                                {{$item->date}}
                                </span>
                                </div>
                                
                                
                                <div>
                                <i class="fas fa-info bg-primary"></i>
                                <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> {{$item->created_at->format('H:i:s')}}</span>
                                <h3 class="timeline-header">تفصيل المتابعة التربوية</h3>
                                <div class="timeline-body">
                                    <dl>
                                        <dt>تقييم المستوى الأكاديمي</dt>
                                        <dd>{{ $item->academic_assessment }}</dd>
                
                                        <dt>خطط التعلم الفردية </dt>
                                        <dd>{{ $item->learning_plan }}</dd>
                
                                        <dt>تتبع التقدم</dt>
                                        <dd>{{ $item->progress_notes }}</dd>
                
                
                                    </dl>
                                </div>

                                </div>
                                </div>
                                </div>                          
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection