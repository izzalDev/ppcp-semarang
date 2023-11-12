<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;

class ProfileInformationController extends Controller
{
    public function show(Request $request)
    {
        return Inertia::render('Profile/Show', [
            'sessions' => $this->sessions($request)->all()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update(['name' => $request->name]);

        if (auth()->user()->email != $request->email) {
            auth()->user()->newEmail($request->email);
            Session::flash('email', 'Please open your new email and verify to make your email change');
        }
    }

    public function sessions(Request $request)
    {
        return collect(
            DB::table('sessions')
                ->where('user_id', $request->user()->id)
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);

            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    protected function createAgent($session)
    {
        return tap(new Agent(), fn ($agent) => $agent->setUserAgent($session->user_agent));
    }
}
