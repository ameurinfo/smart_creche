<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProfilesController extends Controller
{
    public function show()
    {
        $active_menu = 'notifications.';
        $active_supmenu = 'notifications.index';
        $user = Auth::user();
        return view('profiles.edit',compact('active_menu','active_supmenu','user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'job' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'phone_number' => 'nullable|string|max:15'
            ]);

        $user->name = $request->input('name');
        
        // Check if user is a parent or staff and update accordingly
        if ($user->hasRole('parents')) {
            $parent = $user->parent;
            $parent->name = $request->input('name');
            $parent->job = $request->input('job');
            $parent->phone_number = $request->input('phone_number');
            
            $parent->save();
        } else {
            $staff = $user->staff;
            $staff->name = $request->input('name');
            $staff->job_title = $request->input('job_title');
            $staff->birthdate = $request->input('birthdate');
            $staff->phone_number = $request->input('phone_number');
            
            $staff->save();
        }

        $user->save();

        return redirect()->route('profiles.show')->with('success', 'Profile updated successfully.');

    }

    public function updateImage(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        if ($request->hasFile('profile_image')) {
                $path = $this->storeImage($request->file('profile_image'));
        }
        if ($user->hasRole('parents')) {
            $parent = $user->parent;
            if ($request->hasFile('profile_image')) {
                if ($parent->image) {
                    Storage::delete('public/' . $parent->image);
                }
                $parent->image = $path;
            }
            $parent->save();
        } else {
            $staff = $user->staff;
            
            if ($request->hasFile('profile_image')) {
                if ($staff->image) {
                    Storage::delete('public/' . $staff->image);
                }
                $staff->image = $path;
            }
            $staff->save();
        }
        return redirect()->route('profiles.show')->with('success', 'Profile updated successfully.');
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
}
