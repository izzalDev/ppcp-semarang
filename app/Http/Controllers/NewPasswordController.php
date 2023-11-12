<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\CurrentPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class NewPasswordController extends Controller
{
    public function create(Request $request, $token)
    {
        if(!DB::table('password_reset_tokens')->where('email', $request->query('email'))->first()){
            abort(404);
        };
        return Inertia::render('Auth/ResetPassword',[
            'token'=>$token,
            'email'=>$request->query('email')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request){
        $request->validate([
            'current_password' => ['required', new CurrentPassword],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        auth()->user()->update(['password'=>Hash::make($request->input('password'))]);
        return back()->with('success','Your password has been updated');
    }
}
