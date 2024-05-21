@extends('layout-app.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#base_info" data-toggle="tab">المعلومات
                                    اﻷساسية</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact_info" data-toggle="tab">معلومات
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
                                                    <option value="male" {{ $student->gender === 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ $student->gender === 'female' ? 'selected' : '' }}>Female</option>
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
                                                <label for="image">Image</label>
                                                <input type="file" class="form-control-file" id="image" name="image">
                                                @if ($student->image)
                                                    <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="contact_info">
                                    <div class="form-group">
                                        <label for="name">اسم الطفل</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">تاريخ الميلاد</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $student->birthdate }}" required>
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection