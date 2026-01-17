<?php

namespace App\Http\Controllers;

class NotificationsController extends Controller
{
    // في NotificationsController للـ API
    public function index()
    {
        return response()->json([
            'notifications' => auth()->user()->notifications,
        ]);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();

            return response()->json(['message' => 'Notification marked as read.']);
        }

        return response()->json(['message' => 'Notification not found.'], 404);
    }
}
