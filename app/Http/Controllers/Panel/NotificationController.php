<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $notifications = $user->notifications()->latest()->paginate(10);
        return view('panel.notifications.index', [
            'notifications' => $notifications,
        ]);
    }
}
