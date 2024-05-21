@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">تعديل بيانات الموظف</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('staff.update', $staff->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">الاسم:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $staff->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">تاريخ الميلاد:</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $staff->birthdate }}" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">الجنس:</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male" {{ $staff->gender == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ $staff->gender == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">العنوان:</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $staff->address }}">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">رقم الهاتف:</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $staff->phone_number }}">
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني:</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}">
                        </div>
                        <div class="form-group">
                            <label for="job_title">الوظيفة:</label>
                            <input type="text" name="job_title" id="job_title" class="form-control" value="{{ $staff->job_title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="hire_date">تاريخ التوظيف:</label>
                            <input type="date" name="hire_date" id="hire_date" class="form-control" value="{{ $staff->hire_date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="academic_qualifications">المؤهلات الأكاديمية:</label>
                            <textarea name="academic_qualifications" id="academic_qualifications" class="form-control">{{ $staff->academic_qualifications }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="previous_experiences">الخبرات السابقة:</label>
                            <textarea name="previous_experiences" id="previous_experiences" class="form-control">{{ $staff->previous_experiences }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="training_courses">الدورات التدريبية:</label>
                            <textarea name="training_courses" id="training_courses" class="form-control">{{ $staff->training_courses }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">صورة:</label>
                            @if ($staff->image)
                                <img src="{{ Storage::url($staff->image) }}" alt="Staff Image" class="img-thumbnail mb-2" width="150">
                            @endif
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="notes">ملاحظات:</label>
                            <textarea name="notes" id="notes" class="form-control">{{ $staff->notes }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="job_type_id">نوع الوظيفة:</label>
                            <select name="job_type_id" id="job_type_id" class="form-control" required>
                                @foreach ($jobTypes as $jobType)
                                    <option value="{{ $jobType->id }}" {{ $staff->job_type_id == $jobType->id ? 'selected' : '' }}>{{ $jobType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
