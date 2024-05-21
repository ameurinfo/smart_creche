<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report for {{ $student->name }}</title>
    <style>
        body {
            font-family: 'amiri', sans-serif;
            direction: rtl; /* Right-to-left layout for Arabic */
        }
        .calendar {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .calendar th, .calendar td {
            border: 1px solid black;
            width: 14.28%;
            height: 100px;
            vertical-align: top;
            padding: 5px;
            text-align: center;
        }
        .calendar th {
            background-color: #f2f2f2;
        }
        .present {
            background-color: #c8e6c9; /* Light green */
        }
        .absent {
            background-color: #ffcdd2; /* Light red */
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>تقرير الحضور لـ {{ $student->name }} لعام {{ $year }}</h1>
    @foreach(range(1, 12) as $month)
        @php
            $daysInMonth = Carbon\Carbon::create($year, $month, 1)->daysInMonth;
            $firstDayOfMonth = Carbon\Carbon::create($year, $month, 1)->dayOfWeek;
        @endphp
        <h2>{{ \Carbon\Carbon::create($year, $month, 1)->translatedFormat('F') }}</h2>
        <table class="calendar">
            <thead>
                <tr>
                    <th>الأحد</th>
                    <th>الإثنين</th>
                    <th>الثلاثاء</th>
                    <th>الأربعاء</th>
                    <th>الخميس</th>
                    <th>الجمعة</th>
                    <th>السبت</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $day = 1;
                @endphp
                @for($week = 0; $week < 6; $week++)
                    <tr>
                        @for($weekday = 0; $weekday < 7; $weekday++)
                            @if($week == 0 && $weekday < $firstDayOfMonth || $day > $daysInMonth)
                                <td></td>
                            @else
                                @php
                                    $date = \Carbon\Carbon::create($year, $month, $day);
                                    $isPresent = in_array($date->format('Y-m-d'), $student->presentDates);
                                @endphp
                                <td class="{{ $isPresent ? 'present' : 'absent' }}">
                                    {{ $day }}
                                </td>
                                @php
                                    $day++;
                                @endphp
                            @endif
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    @endforeach
</body>
</html>
