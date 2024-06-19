<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Parents;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $active_menu = 'users.';
        $active_supmenu = 'users.index';
        $data = User::latest()->paginate(5);
        return view('users.index',compact('data','active_menu','active_supmenu'));
    }

    public function create()
    {
        $active_menu = 'users.';
        $active_supmenu = 'users.create';
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles','active_menu','active_supmenu'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    public function show($id)
    {
        $active_menu = 'users.';
        $active_supmenu = 'users.show';
        $user = User::find($id);
        return view('users.show',compact('user','active_menu','active_supmenu'));
    }
    
    public function edit($id)
    {
        $active_menu = 'users.';
        $active_supmenu = 'users.show';
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole','active_menu','active_supmenu'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function newParent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'job' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:20',
        ]);

        // Generate a random password
        $password = Str::random(8);

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
        ]);

        // Assign the parent role to the user
        $user->assignRole('parents');

        // Create the parent
        $parent = Parents::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'relationship' => $request->input('relationship'),
            'job' => $request->input('job'),
            'user_id' => $user->id,
        ]);

        // Return the new parent data as JSON
        return response()->json([
            'id' => $parent->id,
            'name' => $parent->name,
        ]);
    }
}