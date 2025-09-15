<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Merchants;
use App\Models\announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function show()
    {
        $id = Auth::user()->user_id;

        $notifications = announcement::where('merchant_id', '"all"')
            ->orWhereJsonContains('merchant_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Merchant.Notification.index', ['notifications' => $notifications]);
    }


    public function details($encryptedId)
    {
        $id = Auth::user()->user_id;
        $notification = announcement::where('id', decrypt($encryptedId))->get();


        return view('Merchant.Notification.detail', ['notification' => $notification]);
    }
}
