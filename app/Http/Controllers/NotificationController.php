<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index()
    {
        $active_menu = 'notifications.';
        $active_supmenu = 'notifications.index';
        $notifications = auth()->user()->notifications()->paginate(10); // Adjust pagination if needed

        return view('notifications.index', compact('notifications','active_menu','active_supmenu'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
