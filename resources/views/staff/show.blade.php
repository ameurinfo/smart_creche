@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل الموظف</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>الاسم</th>
                            <td>{{ $staff->name }}</td>
                        </tr>
                        <tr>
                            <th>تاريخ الميلاد</th>
                            <td>{{ $staff->birthdate }}</td>
                        </tr>
                        <tr>
                            <th>الجنس</th>
                            <td>{{ $staff->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                        </tr>
                        <tr>
                            <th>العنوان</th>
                            <td>{{ $staff->address }}</td>
                        </tr>
                        <tr>
                            <th>رقم الهاتف</th>
                            <td>{{ $staff->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>البريد الإلكتروني</th>
                            <td>{{ $staff->email }}</td>
                        </tr>
                        <tr>
                            <th>الوظيفة</th>
                            <td>{{ $staff->job_title }}</td>
                        </tr>
                        <tr>
                            <th>تاريخ التوظيف</th>
                            <td>{{ $staff->hire_date }}</td>
                        </tr>
                        <tr>
                            <th>المؤهلات الأكاديمية</th>
                            <td>{{ $staff->academic_qualifications }}</td>
                        </tr>
                        <tr>
                            <th>الخبرات السابقة</th>
                            <td>{{ $staff->previous_experiences }}</td>
                        </tr>
                        <tr>
                            <th>الدورات التدريبية</th>
                            <td>{{ $staff->training_courses }}</td>
                        </tr>
                        <tr>
                            <th>صورة</th>
                            <td>
                                @if ($staff->image)
                                    <img src="{{ Storage::url($staff->image) }}" alt="Staff Image" class="img-thumbnail" width="150">
                                @else
                                    لا توجد صورة
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>ملاحظات</th>
                            <td>{{ $staff->notes }}</td>
                        </tr>
                        <tr>
                            <th>نوع الوظيفة</th>
                            <td>{{ $staff->jobType->name }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('staff.index') }}" class="btn btn-primary">رجوع</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
