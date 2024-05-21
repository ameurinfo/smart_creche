@extends('layout-app.base') 
@section('head')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5>
                    <i class="fas fa-list"></i>
                    <span class="float-end">قائمة اﻷطفال</span>
                    </h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الاسم الكامل</th>
                                <th>تاريخ الميلاد</th>
                                <th>الجنس</th>
                                <th>مهام</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->birthdate }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>
                                        <a href="{{ route('children.show', $student) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('children.edit', $student) }}" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('children.destroy', $student) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
@include('layout-app.js-datatables')
@endsection