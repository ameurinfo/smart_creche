@extends('layout-app.base')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <strong><i class="fas fa-edit"></i> تسجيل الحضور</strong>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($absentStudents->isEmpty())
                            <p>لا يوجد أطفال لم يتم تسجيل حضورهم بعد لهذا اليوم.</p>
                        @else

                        <form method="POST" action="{{ route('attendance.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="date">تاريخ الحضور:</label>
                                <div class="input-group">
                                    <input type="date" name="date" id="date" class="form-control" value="{{ $currentDate }}" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" id="toggleDateBtn">اليوم</button>
                                    </div>
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>اسم الطفل</th>
                                        <th> الحضور ؟</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absentStudents as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                <input type="checkbox" name="students[{{ $student->id }}]" value="1">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> تسجيل الحضور</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <strong><i class="fas fa-check-circle"></i>
                        اﻷطفال الحاضرون اليوم
                        </strong>
                    </div>

                    <div class="card-body">
                        @if ($attendedStudents->isNotEmpty())
                        <table id="example2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>اسم الطفل</th>
                                    <th>توقيت الحضور </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendedStudents as $studentAttendances)
                                            @foreach ($studentAttendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->child->name }}</td>
                                        <td>{{ $attendance->arrival_time }}</td>
                                    </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>لا يوجد أطفال حاضرين بعد لهذا اليوم.</p>
                        @endif
                    </div>
                </div>
            </div> 

        </div>
    </div>
@endsection
@section('footer')
@include('layout-app.js-datatables')
<script>
    document.getElementById('toggleDateBtn').addEventListener('click', function() {
        var dateInput = document.getElementById('date');
        var currentDate = new Date().toISOString().split('T')[0];
        dateInput.value = dateInput.value === currentDate ? '' : currentDate;
    });
</script>
@endsection
