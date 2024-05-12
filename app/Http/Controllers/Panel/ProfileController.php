<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $setting = \Helper::getSetting();
        return view('panel.profile.index', [
            'title' => $setting->software_name,
            'logo_url' => $setting->software_logo_white,
            'description' => $setting->software_description,
            'instagram' => ltrim($setting->instagram, '@'),
            'whatsapp' => $setting->whatsapp,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
        ]);

        $data = $request->except(['email', 'old_password', 'new_password']);

        if(!empty($request->old_password)) {
            if (Hash::check($request->old_password, auth()->user()->password)) {
                $request->validate([
                    'new_password' => 'required|min:6',
                ]);

                $data['password'] = $request->new_password;
            } else {
                return back()->with('error', 'Senha não confere')->withInput();
            }
        }

        if(auth()->user()->update($data)) {
            return back()->with(['success' => 'Dados alterados com sucesso'])->withInput();
        }
    }
}
