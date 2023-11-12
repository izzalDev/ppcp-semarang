<?php

namespace App\Http\Controllers;

use App\Rules\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherBrowserSessionController extends Controller
{
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', new CurrentPassword],
        ]);

        DB::table(config('session.table', 'sessions'))
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->where('id', '!=', $request->session()->getId())
            ->delete();
    }
}
