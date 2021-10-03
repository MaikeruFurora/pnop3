<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function forbidden()
    {
        return view('auth/forbidden');
    }

    public function login()
    {
        // return view('welcome');
        return view('auth/login');
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'get_your_input' => 'required',
            'password' => 'required',
            // 'user_type' => 'required'
        ]);
        return $this->checkUserLogin($request);
    }

    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        }
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        }
        if (session()->has('sessionAY')) {
            session()->flush();
        }
        return redirect()->route('auth.login');
    }

    public function checkUserLogin($request)
    {
        $fieldType = ctype_digit($request->get_your_input) ? 'roll_no' : 'username';
        $request->merge([
            $fieldType => $request->input('get_your_input')
        ]);
        $credits = $request->only($fieldType, 'password');
        session()->put('sessionAY', SchoolYear::where('status', 1)->first());

        if ($fieldType == 'username') {
            if (Auth::guard('web')->attempt($credits)) {
                return redirect()->route('admin.dashboard'); //if admin
            } else {
                return $this->partofIt($credits);
            }
        } else {
            return $this->partofIt($credits);
        }
    }

    public function partofIt($credits)
    {
        if (Auth::guard('teacher')->attempt($credits)) {
            return redirect()->route('teacher.dashboard'); //if teacher or faculty
        } else {
            if (Auth::guard('student')->attempt($credits)) {
                return redirect()->route('student.dashboard'); //if student
            } else {
                return redirect()->route('auth.login')->with('msg', 'Login credentials are invalid');
            }
        }
    }
}
