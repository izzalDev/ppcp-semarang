<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PhotoProfileController extends Controller
{
    public function update(Request $request)
    {
        if($request->file('image')){
            if(auth()->user()->image){
                Storage::delete(auth()->user()->image);
            }
            $file=$request->file('image')->store('/assets/profile-picture');
            auth()->user()->update(['image'=> $file]);
        }
    }

    public function show(Request $request){
        $image=basename(auth()->user()->image);
        if($image==$request->filename) {
            $file = Storage::get(auth()->user()->image);
            $type = Storage::mimeType(auth()->user()->image);
            $response = Response::make($file, 200);
            $response->header('Content-Type', $type);
            return $response;
        }
        abort(404);
    }
}
