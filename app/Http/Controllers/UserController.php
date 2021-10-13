<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 0) {
                $userQuery = User::where('name', 'like', "%" . $request->keyword . "%")->orWhere('email', 'like', "%" . $request->keyword . "%");
                $user = $userQuery->paginate(20);
                return view('user.index', compact('user'));
            } else {
                return redirect()->back()->with('msg', "Bạn không có quyền!");
            }
        } else {
            return redirect()->back()->with('msg', "Chưa đăng nhập!");
        }
    }

    public function add()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 0) {
                return view('user.add');
            } else {
                return redirect()->back()->with('msg', "Bạn không có quyền!");
            }
        } else {
            return redirect()->back()->with('msg', "Chưa đăng nhập!");
        }
    }

    public function save_add(Request $request)
    {
        User::create($request->all());
        return redirect(route('list_cate'));
    }

    public function remove($user)
    {
        User::find($user)->delete();
        return redirect(route('list_cate'));
    }

    public function edit()
    {
        return view('user.info');
    }

    public function edit_info(User $id)
    {
        return view('user.edit', ['user' => $id]);
    }

    public function edit_pass(User $id)
    {
        return view('user.editpass', ['user' => $id]);
    }

    public function save_edit_pass(Request $request, $id)
    {
        $user = User::find($id);
        $new_pass = $_POST['password'];
        $cf_pass = $_POST['cf_password'];
        if ($new_pass != $cf_pass) {
            return redirect()->back()->with('msg', "Password and confirm password do not match!");
        } else {
            $user->fill($request->all());
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('info_user'));
        }
    }

    public function save_edit_info(Request $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect(route('info_user'));
    }
}
