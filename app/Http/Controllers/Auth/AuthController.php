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

    public function login()
    {
        return view('auth/login');
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'get_your_input' => 'required',
            'password' => 'required',
            'user_type' => 'required'
        ]);

        $fieldType = ctype_digit($request->get_your_input) ? 'roll_no' : 'username';
        $request->merge([
            $fieldType => $request->input('get_your_input')
        ]);
        $credits = $request->only($fieldType, 'password');

        switch ($request->user_type) {
            case 'Administrator':
                if (Auth::guard('web')->attempt($credits)) {
                    session()->put('sessionAY', SchoolYear::where('status', 1)->first());
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('auth.login')->with('msg', 'Login credentials is invalid');
                }
                break;

            case 'Teacher':
                session()->put('sessionAY', SchoolYear::where('status', 1)->first());
                if (Auth::guard('teacher')->attempt($credits)) {
                    return redirect()->route('teacher.dashboard');
                } else {
                    return redirect()->route('auth.login')->with('msg', 'Login credentials is invalid');
                }
                break;

            case 'Student':
                if (Auth::guard('student')->attempt($credits)) {
                    session()->put('sessionAY', SchoolYear::where('status', 1)->first());
                    return redirect()->route('student.dashboard');
                } else {
                    return redirect()->route('auth.login')->with('msg', 'Login credentials is invalid');
                }
                break;

            default:
                return redirect()->route('auth.login')->with('msg', 'Login as is not defined');
                break;
        }
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
}
