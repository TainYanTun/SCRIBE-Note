<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(10); // Paginate for better performance

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return back()->with('status', 'Notification marked as read.');
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back()->with('status', 'All notifications marked as read.');
    }
}
