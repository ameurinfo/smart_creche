@extends('layout-app.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <strong><i class="fas fa-edit"></i> تسجيل وقت المغادرة</strong>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($attendedStudents->isEmpty())
                            <p>لا يوجد أطفال حاضرين بعد لهذا اليوم.</p>
                        @else
                        <form method="POST" action="{{ route('attendance.departure') }}">
                            @csrf

                                <div class="form-group">
                                    <label>اختر اﻷطفال:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllStudents">
                                        <label class="form-check-label" for="selectAllStudents">تحديد الكل</label>
                                    </div>
                                </div>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>اسم الطفل</th>
                                            <th>توقيت الحضور</th>
                                            <th>توقيت المغادرة</th>
                                            <th>ملاحظات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendedStudents as $studentAttendances)
                                            @foreach ($studentAttendances as $attendance)
                                                @if ($attendance->departure_time === null)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input studentCheckbox" type="checkbox" name="students[]" value="{{ $attendance->id }}">
                                                            </div>
                                                        </td>
                                                        <td>{{ $attendance->child->name }}</td>
                                                        <td>{{ $attendance->arrival_time }}</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="time" name="departure_time[{{ $attendance->id }}]" class="form-control" id="departureTime{{ $attendance->id }}">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-primary" onclick="toggleDepartureTime({{ $attendance->id }})">الآن</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="notes[{{ $attendance->id }}]" class="form-control">
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <label for="commonDepartureTime">توقيت المغادرة المشترك:</label>
                                    <div class="input-group">
                                        <input type="time" name="commonDepartureTime" id="commonDepartureTime" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="setCommonDepartureTime()">تطبيق</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> تسجيل وقت المغادرة</button>
                            </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAllStudents = document.getElementById('selectAllStudents');
            var studentCheckboxes = document.querySelectorAll('.studentCheckbox');

            selectAllStudents.addEventListener('change', function() {
                studentCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllStudents.checked;
                });
            });
        });

        function toggleDepartureTime(attendanceId) {
            var departureTimeInput = document.getElementById('departureTime' + attendanceId);
            var currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            departureTimeInput.value = departureTimeInput.value === currentTime ? '' : currentTime;
        }

        function setCommonDepartureTime() {
            var commonDepartureTime = document.getElementById('commonDepartureTime').value;
            var studentCheckboxes = document.querySelectorAll('.studentCheckbox:checked');

            studentCheckboxes.forEach(function(checkbox) {
                var attendanceId = checkbox.value;
                var departureTimeInput = document.getElementById('departureTime' + attendanceId);
                departureTimeInput.value = commonDepartureTime;
            });
        }
    </script>
@endsection