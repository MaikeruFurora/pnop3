<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        return User::updateorcreate(['id' => $request->id], [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
    }

    public function list()
    {
        return response()->json(User::select('id', 'name', 'username')->get());
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }
}
