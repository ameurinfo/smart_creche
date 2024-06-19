@extends('layout-app.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>عرض تفاصيل بيانات الطفل</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                @if($student->gender == 'ذكر')
                                src="{{ $student->image ? asset('storage/' . $student->image) : asset('backend/dist/img/avatar10.jpg') }}" alt="{{ $student->name }}"
                                @else
                                src="{{ $student->image ? asset('storage/' . $student->image) : asset('backend/dist/img/avatar12.png') }}" alt="{{ $student->name }}"
                                @endif
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $student->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>رقم التسجيل</b> <a class="float-right">{{ $student->id }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>تاريخ التسجيل</b> <a class="float-right">{{ $student->created_at->format('Y.m.d')}}</a>
                            </li>
                            @unless(Auth::user()->hasRole('parents'))
                                <a href="{{ route('children.edit', $student) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            @endunless
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#base_info" data-toggle="tab">المعلومات
                                    اﻷساسية</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact_info" data-toggle="tab">معلومات
                                    الاتصال</a></li>
                            <li class="nav-item"><a class="nav-link" href="#educational_follow_up"
                                    data-toggle="tab">المتابعة التربوية</a></li>
                            <li class="nav-item"><a class="nav-link" href="#health_follow_up" data-toggle="tab">المتابعة
                                    الصحية</a></li>
                            <li class="nav-item"><a class="nav-link" href="#psychological_follow_up"
                                    data-toggle="tab">المتابعة النفسية</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="base_info">
                                <div class="row">
                                    <div class="col-md-8">
                                        <dl>
                                            <dt><i class="fas fa-solid fa-user"></i> الاسم الكامل</dt>
                                            <dd>{{ $student->name }}</dd>
                            
                                            <dt><i class="fas fa-calendar"></i> تاريخ الميلاد</dt>
                                            <dd>{{ $student->birthdate }}</dd>
                            
                                            <dt><i class="fas fa-genderless"></i> الجنس</dt>
                                            <dd>{{ $student->gender }}</dd>
                            
                                            <dt><i class="fas fa-solid fa-users"></i> اسم ولي اﻷمر</dt>
                                            <dd>{{ $student->parents->name }}</dd>
                            
                                            <dt><i class="fas fa-solid fa-clipboard"></i> ملاحظات</dt>
                                            <dd>{{ $student->notes }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4">
                                        <img 
                                        @if($student->gender == 'ذكر')
                                        src="{{ $student->image ? asset('storage/' . $student->image) : asset('backend/dist/img/avatar10.jpg') }}" alt="{{ $student->name }}"
                                        @else
                                        src="{{ $student->image ? asset('storage/' . $student->image) : asset('backend/dist/img/avatar12.png') }}" alt="{{ $student->name }}"
                                        @endif
                                        alt="{{ $student->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 300px;">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="contact_info">
                                <dl>
                                    <dt><i class="fas fa-solid fa-building"></i> العنوان</dt>
                                    <dd>{{ $student->address }}</dd>

                                    <dt><i class="fas fa-solid fa-phone"></i> رقم الهاتف</dt>
                                    <dd>{{ $student->phone_number }}</dd>

                                    <dt><i class="fas fa-solid fa-at"></i> الايميل</dt>
                                    <dd>{{ $student->email }}</dd>
                                </dl>
                            </div>
                            <div class="tab-pane" id="educational_follow_up">
                                @if ($student->educational_follow_up->count() > 0)
                                @foreach ($student->educational_follow_up as $item)
                                    <div class="timeline timeline-inverse">

                                        <div class="time-label">
                                            <span class="bg-success">
                                                {{ $item->date }}
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-info bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    {{ $item->created_at->format('H:i:s') }}</span>
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
                                @else
                                لم يتم العثور على سجلات المتابعة التربوية
                                @endif
                            </div>
                            <div class="tab-pane" id="health_follow_up">
                                @if ($student->health_follow_up->count() > 0)
                                @foreach ($student->health_follow_up as $item)
                                    <div class="timeline timeline-inverse">

                                        <div class="time-label">
                                            <span class="bg-danger">
                                                {{ $item->date }}
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-info bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    {{ $item->created_at->format('H:i:s') }}</span>
                                                <h3 class="timeline-header">تفصيل المتابعة الصحية</h3>
                                                <div class="timeline-body">
                                                    <dl>
                                                        <dt>ملاحظات  </dt>
                                                        <dd>{{ $item->notes }}</dd>

                                                    </dl>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                لم يتم العثور على سجلات المتابعة الصحية
                                @endif
                            </div>
                            <div class="tab-pane" id="psychological_follow_up">
                                @if ($student->psychological_follow_up->count() > 0)
                                @foreach ($student->psychological_follow_up as $item)
                                    <div class="timeline timeline-inverse">

                                        <div class="time-label">
                                            <span class="bg-warning">
                                                {{ $item->date }}
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-info bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    {{ $item->created_at->format('H:i:s') }}</span>
                                                <h3 class="timeline-header">تفصيل المتابعة النفسية</h3>
                                                <div class="timeline-body">
                                                    <dl>
                                                        <dt>ملاحظات حول الحالة النفسية </dt>
                                                        <dd>{{ $item->observations }}</dd>

                                                    </dl>
                                                    <dl>
                                                        <dt>خطط الدعم  </dt>
                                                        <dd>{{ $item->support_plan }}</dd>

                                                    </dl>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                لم يتم العثور على سجلات المتابعة النفسية
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
