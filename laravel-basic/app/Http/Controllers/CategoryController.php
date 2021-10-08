<?php

namespace App\Http\Controllers;

use App\Http\Requests\CateFormRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show()
    {
        $cate = Category::all();
        return view('category.index', compact('cate'));
    }

    public function add()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 0) {
                return view('category.add');
            } else {
                return redirect()->back()->with('msg', "Tài khoản của bạn chỉ có thể xem danh sách!");
            }
        } else {
            return redirect()->back()->with('msg', "Chưa đăng nhập!");
        }
    }

    public function save_add(CateFormRequest $request)
    {
        Category::create($request->all());
        return redirect(route('list_cate'));
    }

    public function edit(Category $cate)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 0) {
                return view('category.edit', ['cate' => $cate]);
            } else {
                return redirect()->back()->with('msg', "Tài khoản của bạn chỉ có thể xem danh sách!");
            }
        } else {
            return redirect()->back()->with('msg', "Chưa đăng nhập!");
        }
    }

    public function save_edit(CateFormRequest $request, $cate)
    {
        Category::find($cate)->update($request->all());
        return redirect(route('list_cate'));
    }

    public function remove($cate)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 0) {
                Item::where('cate_id', 'like', $cate)->delete();
                Category::find($cate)->delete();
                return redirect(route('list_cate'));
            } else {
                return redirect()->back()->with('msg', "Tài khoản của bạn chỉ có thể xem danh sách!");
            }
        } else {
            return redirect()->back()->with('msg', "Chưa đăng nhập!");
        }
    }
}
