<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PushNotificationTrait;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class UserNotificationsController extends Controller
{
    public function testNotification(Request $request)
    {
        ini_set('max_execution_time', 0);

        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
            'device_type' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "data" => '', "message" => $validator->errors()->all()[0],]);
        }
        $notifyDetails["type"] = 'test';
        $notifyDetails["title"] = 'Test title';
        $notifyDetails["body"] = 'Test message';
        $div_token = [$request->device_token];
        $notify_users = auth()->user();
        Notification::send($notify_users, new UserNotification($notifyDetails));
        if (PushNotificationTrait::notifyUser($div_token, $notifyDetails)) {
            return Response()->Json(["status" => true, "message" => 'Successfully Send',]);
        }
        return Response()->Json(["status" => false, "message" => 'Notification not send.',]);


    }

    public function userNotificationList(Request $request)
    {
        try {
            $user =  auth()->user();
            $unreadNotification = $user->unreadNotifications()->count();
            $notification = $user->notifications()->get();
            $get_clield = User::where('parent_id', auth()->user()->id)->get(['id']);
            if ($get_clield->count()) {
                foreach ($get_clield as $key => $clield) {
                    $unreadNotification += $clield->unreadNotifications()->count();
                    $chield_notification = $clield->notifications()->get();
                    $notification = $notification->merge($chield_notification);
                }
            }
            $notification = $notification->take(20);
            // return $notification;
            $data['unreadNotification'] = $unreadNotification;
            $data['notification'] = $notification->each(function ($item) use ($request) {
                $created_at =  strtotime($item->created_at);
                $item->created_at = date('d-m-Y H:i:s', $created_at);
                return $item;
            });


            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (\Exception $e) {
            return Response()->Json(["status" => false, "message" => $e->getMessage(),], 401);
        }
    }

    
    public function readAllUserNotification(Request $request)
    {
        try {
            $request->user()->unreadNotifications->markAsRead();

            return response()->json(['status' => true, 'message' => 'You have successfully read all notifications.'], 200);
        } catch (\Exception $e) {
            return Response()->Json(["status" => false, "message" => $e->getMessage(),], 401);
        }
    }


    public function readNotification(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'notification_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
            }

            $notification = $request->user()->notifications()->find($request->notification_id);

            // $read = $notification->update(['view_at' => now()]);
            $read = $notification->markAsRead();
            if ($notification) {
                return response()->json(['status' => true, 'message' => 'You have successfully view the notification.'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Something went wrong'], 200);
            }
        } catch (\Exception $e) {
            return Response()->Json(["status" => false, "message" => $e->getMessage(),], 401);
        }
    }
}
