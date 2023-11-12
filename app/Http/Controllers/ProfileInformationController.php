<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ProfileInformationController extends Controller
{
    public function show(){
        return Inertia::render('Profile/Show');
    }

    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.auth()->id(),
        ]);

        auth()->user()->update(['name'=>$request->name]);

        if(auth()->user()->email != $request->email){
            auth()->user()->newEmail($request->email);
            Session::flash('email','Please open your new email and verify to make change');
        }
    }
}
