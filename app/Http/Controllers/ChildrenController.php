<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Child;
use App\Models\Parents;
use App\Models\Attendance;
use App\Models\Meal;
use App\Models\Sleep;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active_menu = 'children.';
        $active_supmenu = 'children.index';
        if(Auth::user()->hasRole('parents')) 
        {
            $parent = Auth::user()->parent;
            $students = $parent->children;
            return view('children.index',compact('students','active_menu','active_supmenu'));

        }
        $students = Child::all();
        return view('children.index',compact('students','active_menu','active_supmenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active_menu = 'children.';
        $active_supmenu = 'children.create';
        $parents = Parents::all(); // Fetch all parents data
        return view('children.create', compact('parents', 'active_menu', 'active_supmenu'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',
            'gender' => 'required',
            'parents_id' => 'required|exists:parents,id', // Make parent_id nullable
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
    
        if ($request->hasFile('image')) {
            $fileNameToStore = $this->storeImage($request->file('image'));
            $validatedData['image'] = $fileNameToStore;
        }
    
        $child = Child::create($validatedData);
        $child->parents()->associate($validatedData['parents_id']);
        $child->save();
    
        return redirect()->route('children.index')->with('success', 'Child created successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $active_menu = 'children.';
        $active_supmenu = 'children.index';
        $student = Child::with(['educational_follow_up' => function ($query) {
            $query->orderBy('date', 'desc');
        }])->find($id);
       
        return view('children.show', compact('student','active_menu','active_supmenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $active_menu = 'children.';
        $active_supmenu = 'children.index';
        $student = Child::find($id);
        $parents = Parents::all(); // Fetch all parents data
        
        return view('children.edit', compact('student', 'parents', 'active_menu', 'active_supmenu'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',
            'gender' => 'required',
            'parent_id' => 'required|exists:parents,id',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $student = Child::find($id);

        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::delete('public/' . $student->image);
            }
            $fileNameToStore = $this->storeImage($request->file('image'));
            $validatedData['image'] = $fileNameToStore;
        }

        $student->update($validatedData);
        $student->parents()->associate($validatedData['parent_id']);
        $student->save();

        return redirect()->route('children.index')->with('success', 'Student data updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Child::find($id);
        if ($student->image) {
            Storage::delete('public/' . $student->image);
        }
        $student->delete();
        return redirect()->route('children.index')->with('success', 'Student deleted successfully!');

    }

    public function createMeals()
    {
        $active_menu = 'children.';
        $active_supmenu = 'children.createMeals';
        $currentDate = date('Y-m-d');
        $attendedStudents = Attendance::with('child')->where('date', $currentDate)->get()->groupBy('child_id');

        //$previousMeals = Meal::with('child')->orderBy('date', 'desc')->get();
        // Group previous meals by date and meal type
        $previousMeals = Meal::select('date', 'meal_type', 'description')
            ->groupBy('date', 'meal_type', 'description')
            ->orderBy('date', 'desc')
            ->get();

        return view('children.createMeals', compact('attendedStudents', 'currentDate', 'previousMeals', 'active_menu', 'active_supmenu'));

    }

    public function storeMeals(Request $request)
    {
        $date = $request->input('dateMeals');
        $typeMeals = $request->input('typeMeals');
        $descriptionMeals = $request->input('descriptionMeals');

        foreach ($request->input('students', []) as $childId => $isPresent) {
            if ($isPresent) {
                $child = Child::find($childId);
                if ($child) {
                    Meal::create([
                        'date' => $date,
                        'child_id' => $childId,
                        'meal_type' => $typeMeals,
                        'description' => $descriptionMeals,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Invalid child ID.');
                }
            }
        }

        return redirect()->back()->with('success', 'Meals recorded successfully.');
    }

    /**
     * Display the sleep tracking form.
     */
    public function createSleep()
    {
        $active_menu = 'children.';
        $active_supmenu = 'children.createSleep';
        $currentDate = date('Y-m-d');
        $attendedStudents = Attendance::with('child')->where('date', $currentDate)->get()->groupBy('child_id');

        // Group previous sleeps by date
        $previousSleeps = Sleep::select('date', 'start_time', 'end_time')
            ->groupBy('date', 'start_time', 'end_time')
            ->orderBy('date', 'desc')
            ->get();

        return view('children.createSleep', compact('attendedStudents', 'currentDate', 'previousSleeps', 'active_menu', 'active_supmenu'));
    }

    /**
     * Store the sleep data.
     */
    public function storeSleep(Request $request)
    {
        $request->validate([
            'dateSleep' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'students' => 'required|array',
        ]);

        $date = $request->input('dateSleep');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        foreach ($request->input('students', []) as $studentId => $isPresent) {
            if ($isPresent) {
                Sleep::create([
                    'date' => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'child_id' => $studentId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'تم تسجيل حصة النوم بنجاح.');
    }


    /**
     * Helper method to store image.
     */
    private function storeImage($image)
    {
        $fileExtension = $image->getClientOriginalExtension();
        $fileNameToStore = Carbon::now()->timestamp . '.' . $fileExtension;
        $imagePath = $image->storeAs('images', $fileNameToStore, 'public');

        return $imagePath;
    }

    /**
     * Generate a random password.
     */
    private function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }
}
