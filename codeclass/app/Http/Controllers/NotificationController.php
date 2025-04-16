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

     // Student notifications
     public function studentNotifications()
     {
         $user = Auth::user();
 
         // Check if the user is a student
         if ($user->role !== 'student') {
             return redirect()->route('dashboard')->with('error', 'Access denied. Only students can view this page.');
         }
 
         // Fetch notifications (using Laravel's built-in notifications)
         $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(20)->get();
 
         // Pass to a Blade view (create resources/views/notifications-student.blade.php)
         return view('notifications-student', [
             'notifications' => $notifications,
         ]);
     }
 
     // Teacher notifications
     public function teacherNotifications()
     {
         $user = Auth::user();
 
         // Check if the user is a teacher
         if ($user->role !== 'teacher') {
             return redirect()->route('dashboard')->with('error', 'Access denied. Only teachers can view this page.');
         }
 
         // Fetch notifications (using Laravel's built-in notifications)
         $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(20)->get();
 
         // Pass to a Blade view (create resources/views/notifications-teacher.blade.php)
         return view('notifications-teacher', [
             'notifications' => $notifications,
         ]);
     }
}