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

        $setting = \Helper::getSetting();
        $notifications = $user->notifications()->latest()->paginate(10);
        return view('panel.notifications.index', [
            'title' => $setting->software_name,
            'logo_url' => $setting->software_logo_white,
            'description' => $setting->software_description,
            'instagram' => ltrim($setting->instagram, '@'),
            'whatsapp' => $setting->whatsapp,
            'notifications' => $notifications,
        ]);
    }
}
