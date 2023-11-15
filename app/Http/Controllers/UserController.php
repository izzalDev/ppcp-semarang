<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $words = explode(' ', $request->query('search'));
        $perPage = $request->query('perPage') ?? 10;
        $users = User::query()
            ->with('roles:name')
            ->where(function ($query) use ($words){
                foreach ($words as $key){
                    $query->orWhere('name','LIKE','%'.$key.'%');
                }
            })
            ->orWhere(function ($query) use ($words){
                foreach ($words as $key){
                    $query->orWhere('email','LIKE','%'.$key.'%');
                }
            })
            ->orwhereHas('roles', function ($query) use ($words) {
                foreach ($words as $key){
                    $query->where('name','LIKE','%'.$key.'%');
                }
            })
            ->orderBy('last_seen', 'desc')
            ->latest()
            ->paginate($perPage, ['id', 'name', 'email', 'image', 'last_seen', 'created_at'])
            ->withQueryString();
        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email|email:dns',
        ]);
        $validated['password'] = Str::random();
        User::create($validated);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message'=>'Please tell user to check email for verify and change password'])
            : back()->withErrors(['error'=>__($status)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
