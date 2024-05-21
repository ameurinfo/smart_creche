<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تتبع الحضور</title>
    <style>
        body {
            font-family: 'vazirmatn', serif;
        }
        header, footer {
            text-align: center;
            margin: 20px 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .present {
            background-color: #d4edda;
        }

        .absent {
            background-color: #f8d7da;
        }

        header, footer {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        <h2>الجمهورية الجزائرية الديمقراطية الشعبية</h2>
        <h3>وزارة التضامن الوطني واﻷسرة وقضايا المرأة</h3>
        <h3>مؤسسة منار للطفولة الصغيرة</h3>
    </header>

    <h1>تتبع الحضور</h1>
    <h3>اسم الطفل: {{ $currentStudent->name }}</h3>
    <h3>السنة: {{ $currentYear }}</h3>
    @php
        \Carbon\Carbon::setLocale('ar');
        $totalPresentDays = 0;
    @endphp
    @for ($month = 1; $month <= 12; $month++)
        <h2>الشهر: {{ \Carbon\Carbon::create(null, $month)->formatLocalized('%B') }}</h2>
        <table>
            <tr>
                <th>اليوم</th>
                @php $daysInMonth = \Carbon\Carbon::create($currentYear, $month, 1)->daysInMonth; @endphp
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @if (!\Carbon\Carbon::create($currentYear, $month, $day)->isWeekend())
                        <th>{{ $day }}</th>
                    @endif
                @endfor
            </tr>
            <tr>
                <td></td>
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @if (!\Carbon\Carbon::create($currentYear, $month, $day)->isWeekend())
                        <td @php $date = \Carbon\Carbon::create($currentYear, $month, $day)->format('Y-m-d'); @endphp
                            @if (in_array($date, $currentStudent->presentDates))
                            class="present"
                            @elseif (in_array($date, $currentStudent->absentDates))
                            class="absent"
                            @endif
                        >
                            @if (in_array($date, $currentStudent->presentDates))
                                X
                            @endif
                        </td>
                    @endif
                @endfor
            </tr>
        </table>
        @php
            $monthPresentDays = count(array_filter($currentStudent->presentDates, function ($date) use ($currentYear, $month) {
                return \Carbon\Carbon::parse($date)->year == $currentYear && \Carbon\Carbon::parse($date)->month == $month;
            }));
            $totalPresentDays += $monthPresentDays;
        @endphp
    @endfor
    <h4>العدد الكلي ﻷيام الحضور:<strong> {{ $totalPresentDays }} </strong> يوم</h4>

    <footer>
        <p>العنوان: حي السعدات بناية 500 مقابل بنك بدر- الجلفة</p>
    </footer>
</body>
</html>