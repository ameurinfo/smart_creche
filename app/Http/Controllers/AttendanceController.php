<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Attendance;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\DepartureNotification;
use Illuminate\Support\Facades\Auth;

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
        $validator = Validator::make($request->all(), [
            'departureTime' => 'nullable|date_format:H:i',
            'students' => 'required|array',
            'students.*' => 'exists:attendances,id', // Ensure attendance IDs are valid
        ], [
            'departureTime.time_format' => 'The departure time must be in the format HH:MM.',
            'students.required' => 'Please select at least one student.',
            'students.*.exists' => 'The selected student is not valid.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $selectedStudents = $request->input('students', []);
        $departureTime = $request->input('departureTime');

        if (!empty($departureTime)) {
            $departureTime = Carbon::parse($departureTime);
        } else {
            $departureTime = now();
        }
        foreach ($selectedStudents as $attendanceId) {
            $attendance = Attendance::find($attendanceId);

            if ($attendance) {
                $attendance->update([
                    'departure_time' => $departureTime,
                    'notes' => $request->input('notes.' . $attendanceId),
                ]);
                if ($request->has('notes.' . $attendanceId) && !empty($request->input('notes.' . $attendanceId))) {
                    $parent = $attendance->child->parents->user; 
                    if ($parent) {
                        $parent->notify(new DepartureNotification($attendance));
                    }
                }
            } else {
                // Handle case where attendance record is not found
            }
        }

        return redirect()->back()->with('success', 'تم تسجيل وقت المغادرة بنجاح.');
    }

    /* public function tracking(Request $request)
    {
        $active_menu = 'children.';
        $active_supmenu = 'attendance.tracking';
        $currentMonth = $request->query('month', date('n'));
        $currentYear = $request->query('year', date('Y'));
        $studentId = $request->query('student');
        
        
        $students = Child::with(['attendances' => function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('date', $currentYear)
                  ->whereMonth('date', $currentMonth);
        }])->paginate(10);
        
        $currentStudent = $students->find($studentId) ?? $students->first();

        $currentStudent->presentDates = $this->calculatePresentAbsentDates($currentYear, $currentMonth, $currentStudent);
        $currentStudent->absentDates = $this->calculateAbsentDates($currentYear, $currentMonth, $currentStudent);
        return view('attendance.tracking', compact('students', 'currentStudent', 'currentMonth', 'currentYear', 'active_supmenu', 'active_menu'));
    } */


    public function tracking(Request $request)
    {
        $active_menu = 'children.';
        $active_supmenu = 'attendance.tracking';
        $currentMonth = $request->query('month', date('n'));
        $currentYear = $request->query('year', date('Y'));
        $studentId = $request->query('student');

        if(Auth::user()->hasRole('parents')) {
            $parent = Auth::user()->parent;
            $students = $parent->children()->paginate(10); // Assuming 'children' is the relationship method in your Parent model

            // If you want to filter by month and year for attendance
            $students->load(['attendances' => function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('date', $currentYear)
                      ->whereMonth('date', $currentMonth);
            }]);
        } else {
            // For other roles, fetch all children
            $students = Child::with(['attendances' => function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('date', $currentYear)
                      ->whereMonth('date', $currentMonth);
            }])->paginate(10);
        }

        $currentStudent = $students->find($studentId) ?? $students->first();

        // Assuming these methods exist to calculate attendance
        $currentStudent->presentDates = $this->calculatePresentAbsentDates($currentYear, $currentMonth, $currentStudent);
        $currentStudent->absentDates = $this->calculateAbsentDates($currentYear, $currentMonth, $currentStudent);

        return view('attendance.tracking', compact('students', 'currentStudent', 'currentMonth', 'currentYear', 'active_supmenu', 'active_menu'));
    }


    
    public function exportPdf(Request $request)
    {
        
        $currentMonth = $request->query('month', date('n'));
        $currentYear = $request->query('year', date('Y'));
        $studentId = $request->query('student');
        
        
        $student = Child::with(['attendances' => function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('date', $currentYear)
                  ->whereMonth('date', $currentMonth);
        }])->find($studentId);
        if (!$student) {
            return redirect()->back()->with('error', 'لم يتم العثور على الطالب.');
        }
        
        $student->presentDates = $this->calculatePresentAbsentDates($currentYear, $currentMonth, $student);
        $student->absentDates = $this->calculateAbsentDates($currentYear, $currentMonth, $student);

        $data = [
            'student' => $student,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'daysInMonth' => Carbon::create($currentYear, $currentMonth, 1)->daysInMonth,
        ];
        //$pdf = PDF::loadView('attendance.pdf', compact('students', 'currentStudent', 'currentMonth', 'currentYear','daysInMonth'));
        $pdf = PDF::loadView('attendance.pdf', $data);
        return $pdf->download('attendance_' . $student->name . '_' . $currentYear . '.pdf');

    }

    
    private function calculatePresentAbsentDates($currentYear, $currentMonth, $student)
    {
        $presentDates = [];
        $daysInMonth = Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);
            if (!$date->isWeekend()) {
                if ($student->attendances->contains('date', $date->format('Y-m-d'))) {
                    $presentDates[] = $date->format('Y-m-d');
                }
            }
        }

        return $presentDates;
    }

    
    private function calculateAbsentDates($currentYear, $currentMonth, $student)
    {
        $absentDates = [];
        $daysInMonth = Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);
            if (!$date->isWeekend() && !$student->attendances->contains('date', $date->format('Y-m-d'))) {
                $absentDates[] = $date->format('Y-m-d');
            }
        }

        return $absentDates;
    }



}
