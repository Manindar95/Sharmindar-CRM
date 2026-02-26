<?php

namespace Webkul\Admin\Http\Controllers\Setting;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\Admin\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::settings.notifications.index');
    }

    /**
     * Get all notifications for the current user.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getNotifications()
    {
        $user = auth()->guard('user')->user();

        $query = $user->notifications();

        if (request()->has('limit')) {
            $query->limit(request()->get('limit'));
        }

        $notifications = $query->get()->map(function ($notification) {
            $notification->created_at_relative = $notification->created_at->diffForHumans();
            
            return $notification;
        });

        return new JsonResource([
            'notifications'    => $notifications,
            'unread_count'     => $user->unreadNotifications()->count(),
            'all_notification' => route('admin.settings.notifications.index'),
        ]);
    }

    /**
     * Mark all notifications as read.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function markAllRead()
    {
        auth()->guard('user')->user()->unreadNotifications->markAsRead();

        return new JsonResource([
            'message' => trans('admin::app.notifications.all-read-success'),
        ]);
    }
}
