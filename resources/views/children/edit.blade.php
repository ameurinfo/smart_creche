@extends('layout-app.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#base_info" data-toggle="tab"><i class="fas fa-edit"></i> المعلومات
                                    اﻷساسية</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact_info" data-toggle="tab"><i class="fas fa-info"></i> معلومات
                                    الاتصال</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('children.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="tab-content">
                                <div class="active tab-pane" id="base_info">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name">اسم الطفل</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdate">تاريخ الميلاد</label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $student->birthdate }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender">الجنس</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="ذكر" {{ $student->gender === 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                                    <option value="أنثى" {{ $student->gender === 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_id">ولي اﻷمر</label>
                                                <select class="form-control" id="parent_id" name="parent_id" required>
                                                    @foreach ($parents as $parent)
                                                        <option value="{{ $parent->id }}" {{ $student->parents->id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">                                       
                                            <div class="form-group">
                                                <label for="image">الصورة</label>
                                                <div id="imagePreviewContainer">
                                                    @if ($student->image)
                                                        <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}" class="img-thumbnail" style="max-width: 200px;">
                                                    @endif
                                                </div>
                                                <input type="file" class="form-control-file mt-2" id="imagePreview" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="contact_info">
                                    <div class="form-group">
                                        <label for="address">العنوان </label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $student->address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">رقم الهاتف </label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $student->phone_number }}">
                                    </div>
                                </div>
                            </div>  
                            <button type="submit" class="btn btn-primary"><i class="fas fa-pen"></i> تحديث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script>
    document.getElementById('imagePreview').addEventListener('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            imagePreviewContainer.innerHTML = '<img src="' + event.target.result + '" class="img-thumbnail" style="max-width: 200px;">';
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>  
@endsection