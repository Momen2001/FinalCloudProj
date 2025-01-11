<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationRequest;
use App\Jobs\SendNotification;
use App\Models\Notification;
use Carbon\Carbon;
use Gate;

class NotificationsController extends Controller
{
    public function index()
    {
        $data['notifications'] = Notification::query()->orderById()->get();
        return view('admin.notifications.index', $data);
    }

    public function store(NotificationRequest $request)
    {
        if (filled($request->image)) {
            $image = null;
            if ($request->has('image')) {
                $image = uniqid() . '.' . $request->image->guessExtension();
                $request->file('image')->storeAs('public/notifications', $image);
                $request->image = $image;
            }
        } else {
            $image = null;
        }

        $data = [
            'ar' => [
                'title' => $request->title_ar,
                'body' => $request->body_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'body' => $request->body_en,
            ],
            'date' => Carbon::now(),
            'is_read' => 0,
            'data_backend' => "{}",
            'link' => '',
            'image' => $image,
            'user_id' => null,
            'platform' => $request->platform,
        ];
        $notification = Notification::query()->create($data);

        $this->dispatch(new SendNotification($notification->id));
        return response()->json([
            'status' => true,
        ]);
    }

}
