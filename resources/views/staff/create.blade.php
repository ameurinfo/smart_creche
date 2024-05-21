@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">إضافة موظف جديد</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">الاسم:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">تاريخ الميلاد:</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">الجنس:</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male">ذكر</option>
                                <option value="female">أنثى</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">العنوان:</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">رقم الهاتف:</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني:</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="job_title">الوظيفة:</label>
                            <input type="text" name="job_title" id="job_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="hire_date">تاريخ التوظيف:</label>
                            <input type="date" name="hire_date" id="hire_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="academic_qualifications">المؤهلات الأكاديمية:</label>
                            <textarea name="academic_qualifications" id="academic_qualifications" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="previous_experiences">الخبرات السابقة:</label>
                            <textarea name="previous_experiences" id="previous_experiences" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="training_courses">الدورات التدريبية:</label>
                            <textarea name="training_courses" id="training_courses" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">صورة:</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="notes">ملاحظات:</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="job_type_id">نوع الوظيفة:</label>
                            <select name="job_type_id" id="job_type_id" class="form-control" required>
                                @foreach ($jobTypes as $jobType)
                                    <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
