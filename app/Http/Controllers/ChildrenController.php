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
use App\Models\CumulativeRecord;
use App\Models\PsychologicalFollowUp;
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
     * index the psychology follow up.
     */
    
    public function indexPsychologyFollowUp()
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.psychologyFollowUp';
        $students = Child::all();
        return view('children.indexPsychologyFollowUp',compact('students','active_menu','active_supmenu'));

    }
    /**
     * show the psychology follow up.
     */
    
    public function showPsychologyFollowUp(string $id)
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.psychologyFollowUp';
        $student = Child::with(['psychological_follow_up' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);
        return view('children.showPsychologyFollowUp',compact('student','active_menu','active_supmenu'));

    }
     /** create the psychology follow up form.
     */
    public function createPsychologyFollowUp(string $id)
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.psychologyFollowUp';
        $student = Child::findOrFail($id);
        return view('children.createPsychologyFollowUp',compact('student','active_menu','active_supmenu'));
    }
    /**
     * Store the psychology follow up form.
     */
    public function storePsychologyFollowUp(Request $request, $id)
    {
        $validatedData = $request->validate([
            'dailyMood' => 'required|string',
            'abnormalBehaviors' => 'nullable|string'
        ]);
        $child = Child::findOrFail($id);
        $psychologyFollow = new PsychologicalFollowUp($validatedData);
        $psychologyFollow->child_id = $child->id;
        $psychologyFollow->save();
        return redirect()->route('children.indexPsychologyFollowUp')
                         ->with('success', 'تم إضافة سجل المتابعة النفسية بنجاح!');

    }
    /**
     * index the cumulative record form.
     */
    public function indexBehaviorModification()
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.behaviorModification';
        $students = Child::all();
        return view('children.indexBehaviorModification',compact('students','active_menu','active_supmenu'));
    }
    /**
     * Display the cumulative record form.
     */
    public function createBehaviorModification()
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.behaviorModification';
        return view('children.behaviorModification',compact('active_menu','active_supmenu'));
    }
    /**
     * Store the cumulative record form.
     */
    public function storeBehaviorModification(Request $request, $id)
    {
        
    }
    /**
     * index the cumulative record form.
     */
    public function indexCumulativeRecord()
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.cumulativeRecord';
        $students = Child::all();
        return view('children.indexCumulativeRecord',compact('students','active_menu','active_supmenu'));

    }
    /**
     * show the cumulative record .
     */
    public function showCumulativeRecord(string $id)
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.cumulativeRecord';
        $student = Child::with(['cumulativeRecords' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('children.showCumulativeRecord', compact('student', 'active_menu', 'active_supmenu'));
    }
    /**
     * Display the cumulative record form.
     */
    public function createCumulativeRecord(string $id)
    {
        $active_menu = 'health_safty.';
        $active_supmenu = 'health_safty.cumulativeRecord';
        $student = Child::findOrFail($id);

        return view('children.createCumulativeRecord', compact('student', 'active_menu', 'active_supmenu'));
    }
    /**
     * Store the cumulative record form.
     */
    public function storeCumulativeRecord(Request $request, $id)
    {
        $validatedData = $request->validate([
            'age' => 'required|string',
            'mental_age' => 'nullable|string',
            'disability' => 'nullable|string',
            'family_members' => 'nullable|string',
            'siblings' => 'nullable|string',
            'parents' => 'nullable|string',
            'child_order' => 'nullable|string',
            'living_with' => 'nullable|string',
            'economic_status' => 'nullable|string',
            'home_status' => 'nullable|string',
            'hearing' => 'nullable|string',
            'vision' => 'nullable|string',
            'taste' => 'nullable|string',
            'touch' => 'nullable|string',
            'speech' => 'nullable|string',
            'chronic_disease' => 'nullable|string',
            'intelligence_tests' => 'nullable|string',
            'special_abilities' => 'nullable|string',
            'psychological_tests' => 'nullable|string',
            'cognitive' => 'nullable|array',
            'cognitive.*' => 'string',
            'attention_concentration' => 'nullable|string',
            'memory' => 'nullable|array',
            'memory.*' => 'string',
            'eating' => 'nullable|string',
            'cleanliness' => 'nullable|string',
            'dressing' => 'nullable|string',
            'activities' => 'nullable|array',
            'activities.*' => 'string',
            'highly_emotional' => 'nullable|string',
            'introverted' => 'nullable|string',
        ]);
    
        $child = Child::findOrFail($id);
        $memory = implode(', ', $validatedData['memory']);
        $cognitive = implode(', ', $validatedData['cognitive']);
        $activities = implode(', ', $validatedData['activities']);

        $cumulativeRecord = new CumulativeRecord([
            'age' => $validatedData['age'],
            'mental_age' => $validatedData['mental_age'],
            'disability' => $validatedData['disability'],
            'family_members' => $validatedData['family_members'],
            'siblings' => $validatedData['siblings'],
            'parents' => $validatedData['parents'],
            'child_order' => $validatedData['child_order'],
            'living_with' => $validatedData['living_with'],
            'economic_status' => $validatedData['economic_status'],
            'home_status' => $validatedData['home_status'],
            'hearing' => $validatedData['hearing'],
            'vision' => $validatedData['vision'],
            'taste' => $validatedData['taste'],
            'touch' => $validatedData['touch'],
            'speech' => $validatedData['speech'],
            'chronic_disease' => $validatedData['chronic_disease'],
            'intelligence_tests' => $validatedData['intelligence_tests'],
            'special_abilities' => $validatedData['special_abilities'],
            'psychological_tests' => $validatedData['psychological_tests'],
            'cognitive' => $cognitive,
            'attention_concentration' => $validatedData['attention_concentration'],
            'memory' => $memory,
            'eating' => $validatedData['eating'],
            'cleanliness' => $validatedData['cleanliness'],
            'dressing' => $validatedData['dressing'],
            'activities' => $activities,
            'highly_emotional' => $validatedData['highly_emotional'],
            'introverted' => $validatedData['introverted'],
        ]);
    
        $cumulativeRecord->child_id = $child->id; 
        $cumulativeRecord->save();

        return redirect()->route('children.indexCumulativeRecord')
                         ->with('success', 'تم إضافة السجل التراكمي بنجاح!');
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
