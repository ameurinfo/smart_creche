<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report for {{ $student->name }}</title>
    <style>
        body {
            font-family: 'amiri', sans-serif;
            direction: rtl; /* Right-to-left layout for Arabic */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>تقرير الحضور لـ {{ $student->name }}</h1>
    <table>
        <thead>
            <tr>
                <th>التاريخ</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flattenedAttendanceData as $attendance)
                <tr>
                    <td>{{ $attendance['date'] }}</td>
                    <td>{{ $attendance['present'] ? 'حاضر' : 'غائب' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
