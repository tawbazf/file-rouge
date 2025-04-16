<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Show the notification center
    public function index(Request $request)
    {
        $user = Auth::user();

        // Determine filter (default: all)
        $filter = $request->query('filter', 'all');

        // Get notifications, you may use Eloquent or Laravel's built-in notification system
        $query = $user->notifications()->orderBy('created_at', 'desc');

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($filter === 'important') {
            $query->where('data->type', 'urgent'); // assuming 'type' is stored in data JSON
        }

        $notifications = $query->take(20)->get()->map(function ($notification) {
            // Map notification fields for blade
            return [
                'id'      => $notification->id,
                'type'    => $notification->data['type'] ?? 'default',
                'title'   => $notification->data['title'] ?? 'Notification',
                'message' => $notification->data['message'] ?? '',
                'time'    => $notification->created_at->diffForHumans(),
            ];
        });

        return view('centre-notifications', [
            'notifications' => $notifications,
        ]);
    }

    // Mark a notification as read (AJAX)
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'not found'], 404);
    }
}