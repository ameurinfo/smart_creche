<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Attendance;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function create()
    {
        $active_menu = 'children.';
        $active_supmenu = 'attendance.create';
        $currentDate = date('Y-m-d');
        $attendedStudents = Attendance::with('child')->where('date', $currentDate)->get()->groupBy('child_id');
        $absentStudents = Child::whereNotIn('id', $attendedStudents->keys())->get();
        return view('attendance.create', compact('attendedStudents', 'absentStudents', 'currentDate','active_menu','active_supmenu'));
    }

    public function store(Request $request)
    {
        $date = $request->input('date');

        foreach ($request->input('students', []) as $studentId => $isPresent) {
            if ($isPresent) {
                $existingAttendance = Attendance::where('date', $date)->where('child_id', $studentId)->first();

                if (!$existingAttendance) {
                    Attendance::create([
                        'date' => $date,
                        'child_id' => $studentId,
                        'arrival_time' => now(),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'تم تسجيل الحضور بنجاح.');
    }

    public function showDepartureForm()
    {
        $active_menu = 'children.';
        $active_supmenu = 'attendance.departure';
        $currentDate = date('Y-m-d');
        $departureTime = now();
        $attendedStudents = Attendance::with('child')->where('date', $currentDate)
                        ->whereNull('departure_time') 
                        ->get()
                        ->groupBy('child_id');

        return view('attendance.departure', compact('attendedStudents','departureTime','active_menu','active_supmenu'));
    }
    
    public function storeDeparture(Request $request)
    {
        $selectedStudents = $request->input('students', []);
        $departureTime = $request->input('departureTime');

        if (!empty($departureTime)) {
            $departureTime = Carbon::parse($departureTime);
        } else {
            $departureTime = now();
        }

        foreach ($selectedStudents as $attendanceId) {
            $attendance = Attendance::findOrFail($attendanceId);

            $attendance->update([
                'departure_time' => $departureTime,
                'notes' => $request->input('notes.' . $attendanceId),
            ]);
        }
    
        return redirect()->back()->with('success', 'تم تسجيل وقت المغادرة بنجاح.');
    }

    public function tracking(Request $request)
    {
        $active_menu = 'children.';
        $active_supmenu = 'attendance.tracking';
        $currentMonth = $request->query('month', date('n'));
        $currentYear = $request->query('year', date('Y'));
        $studentId = $request->query('student');
        

        $students = Child::with(['attendances' => function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('date', $currentYear)
                  ->whereMonth('date', $currentMonth);
        }]);
        
        
        $students = $students->paginate(10);

        $currentStudent = $students->find($studentId) ?? $students->first();

        $presentDates = [];
        $absentDates = [];

        
        $daysInMonth = Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);
            if (!$date->isWeekend()) {
                if ($currentStudent->attendances->contains('date', $date->format('Y-m-d'))) {
                    $presentDates[] = $date->format('Y-m-d');
                } else {
                    $absentDates[] = $date->format('Y-m-d');
                }
            }
        }

        $currentStudent->presentDates = $presentDates;
        $currentStudent->absentDates = $absentDates;
        return view('attendance.tracking', compact('students', 'currentStudent', 'currentMonth', 'currentYear', 'active_supmenu', 'active_menu'));
    }

    
    public function exportPdf(Request $request)
    {
        
        $currentMonth = $request->query('month', date('n'));
        $currentYear = $request->query('year', date('Y'));
        $studentId = $request->query('student');
        
        
        $students = Child::with(['attendances' => function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('date', $currentYear)
                  ->whereMonth('date', $currentMonth);
        }]);
        
        
        $students = $students->paginate(10);
        $currentStudent = $students->find($studentId) ?? $students->first();

        $presentDates = [];
        $absentDates = [];

        
        $daysInMonth = Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);
            if (!$date->isWeekend()) {
                if ($currentStudent->attendances->contains('date', $date->format('Y-m-d'))) {
                    $presentDates[] = $date->format('Y-m-d');
                } else {
                    $absentDates[] = $date->format('Y-m-d');
                }
            }
        }

        $currentStudent->presentDates = $presentDates;
        $currentStudent->absentDates = $absentDates;
        $data = [
            'students' => $students,
            'currentStudent' => $currentStudent,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'daysInMonth' => $daysInMonth,
            
        ];
        //$pdf = PDF::loadView('attendance.pdf', compact('students', 'currentStudent', 'currentMonth', 'currentYear','daysInMonth'));
        $pdf = PDF::loadView('attendance.pdf', $data);
        return $pdf->download('attendance_' . $currentStudent->name . '_' . $currentYear . '.pdf');

    }


}
