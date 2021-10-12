<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function save_login(Request $request)
    {
        $request->validate(
            [
                'email' => [
                    "required",
                    "email"
                ],
                'password' => "required"
            ],
            [
                'email.required' => "Hãy nhập email",
                'email.email' => "Không đúng định dạng email",
                'password.required' => "Hãy nhập mật khẩu",
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('home'));
        } else {
            return redirect()->back()->with('msg', 'Tài khoản/mật khẩu không chính xác');
        }
        return view('login');
    }
}
