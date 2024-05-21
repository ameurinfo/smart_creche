<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Staff;
use App\Models\JobType;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active_menu = 'staff';
        $active_supmenu = 'staff.index';
        $staff = Staff::all();
        return view('staff.index', compact('staff', 'active_menu', 'active_supmenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active_menu = 'staff';
        $active_supmenu = 'staff.create';
        $jobTypes = JobType::all();
        return view('staff.create', compact('jobTypes', 'active_menu', 'active_supmenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'job_title' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'academic_qualifications' => 'nullable|string',
            'previous_experiences' => 'nullable|string',
            'training_courses' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notes' => 'nullable|string',
            'job_type_id' => 'required|exists:job_types,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Staff::create($validatedData);

        return redirect()->route('staff.index')->with('success', 'تم إضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $active_menu = 'staff';
        $active_supmenu = 'staff.index';
        $staff = Staff::find($id);
        return view('staff.show', compact('staff', 'active_menu', 'active_supmenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $active_menu = 'staff';
        $active_supmenu = 'staff.index';
        $staff = Staff::find($id);
        $jobTypes = JobType::all();
        return view('staff.edit', compact('staff', 'jobTypes', 'active_menu', 'active_supmenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'job_title' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'academic_qualifications' => 'nullable|string',
            'previous_experiences' => 'nullable|string',
            'training_courses' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notes' => 'nullable|string',
            'job_type_id' => 'required|exists:job_types,id',
        ]);

        $staff = Staff::find($id);

        if ($request->hasFile('image')) {
            if ($staff->image) {
                Storage::delete('public/' . $staff->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $staff->update($validatedData);

        return redirect()->route('staff.index')->with('success', 'تم تحديث بيانات الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        if ($staff->image) {
            Storage::delete('public/' . $staff->image);
        }
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'تم حذف الموظف بنجاح');
    }
}
