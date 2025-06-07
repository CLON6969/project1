<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user->profile_completed) {
            return redirect()->route('user.profile.edit');
        }

        return view('user.dashboard', [
            'user' => $user
        ]);
    }

    public function overview(Request $request)
    {
        $user = $request->user();

        if (!$user->profile_completed) {
            return redirect()->route('user.profile.edit');
        }

        return view('dashboard.overview', [
            'user' => $user
        ]);
    }

    public function reports(Request $request)
    {
        $user = $request->user();

        if (!$user->profile_completed) {
            return redirect()->route('user.profile.edit');
        }

        return view('dashboard.reports', [
            'user' => $user
        ]);
    }
}
