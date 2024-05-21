@extends('layout-app.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5>قائمة اﻷطفال</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        @foreach($students as $student)
                            <li class="nav-item">
                                <a href="{{ route('attendance.tracking', ['student' => $student->id, 'month' => $currentMonth, 'year' => $currentYear]) }}" class="nav-link {{ $currentStudent->id === $student->id ? 'active' : '' }}">
                                    {{ $student->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5>التقويم الحضوري</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>الشهر:</label>
                                <select class="form-control" onchange="changeMonth(this.value)">
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}" {{ $currentMonth == $month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>السنة:</label>
                                <select class="form-control" onchange="changeYear(this.value)">
                                    @for($year = date('Y') - 5; $year <= date('Y') + 5; $year++)
                                        <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="calendar">
                                @php
                                    $daysInMonth = Carbon\Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;
                                    $firstDayOfMonth = Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('N');
                                @endphp
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>اﻷحد</th>
                                            <th>اﻹثنين</th>
                                            <th>الثلاثاء</th>
                                            <th>اﻷربعاء</th>
                                            <th>الخميس</th>
                                            <th>الجمعة</th>
                                            <th>السبت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $day = 1;
                                            $currentDay = 1;
                                        @endphp
                                        @for($week = 1; $week <= 6; $week++)
                                            <tr>
                                                @for($weekday = 1; $weekday <= 7; $weekday++)
                                                    @if(($week == 1 && $weekday < $firstDayOfMonth) || ($day > $daysInMonth))
                                                        <td></td>
                                                    @else
                                                        @php
                                                            $date = Carbon\Carbon::create($currentYear, $currentMonth, $currentDay);
                                                            $isPresent = in_array($date->format('Y-m-d'), $currentStudent->presentDates);
                                                            $isAbsent = in_array($date->format('Y-m-d'), $currentStudent->absentDates);
                                                        @endphp
                                                        <td class="{{ $isPresent ? 'bg-success' : ($isAbsent ? 'bg-danger' : '') }}">
                                                            {{ $currentDay }}
                                                        </td>
                                                        @php
                                                            $currentDay++;
                                                            $day++;
                                                        @endphp
                                                    @endif
                                                @endfor
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('attendance.exportPdf', ['student' => $currentStudent->id, 'year' => $currentYear]) }}" class="btn btn-sm btn-secondary mt-2">
                        <i class="fas fa-download"></i> PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
    <script>
        function changeMonth(month) {
            window.location.href = '{{ route('attendance.tracking') }}?month=' + month + '&year={{ $currentYear }}&student={{ $currentStudent->id }}';
        }

        function changeYear(year) {
            window.location.href = '{{ route('attendance.tracking') }}?month={{ $currentMonth }}&year=' + year + '&student={{ $currentStudent->id }}';
        }
    </script>
@stop
