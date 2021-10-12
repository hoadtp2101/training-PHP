<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemFormRequest;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ItemController extends Controller
{
    public function show(Request $request)
    {
        $itemQuery = Item::where('name', 'like', "%".$request->keyword."%");
        if ($request->has('cate_id') && $request->cate_id > 0) {
            $itemQuery->where('cate_id', $request->cate_id);
        }
        $item = $itemQuery->orderByDesc('id')->paginate(20);
        $cate = Category::all();
        $user = User::all();
        return view('item.index', compact('item', 'cate', 'user'));
    }

    public function add()
    {
        $cate = Category::all();
        $user = User::all();
        return view('item.add', compact('cate', 'user'));
    }

    public function save_add(ItemFormRequest $request)
    {
        Item::create($request->all());
        return redirect(route('list_item'));
    }

    public function edit(Item $item)
    {
        $cate = Category::all();
        $user = User::all();
        return view('Item.edit', ['item' => $item], compact('cate', 'user'));
    }

    public function save_edit(ItemFormRequest $request, $item)
    {
        Item::find($item)->update($request->all());
        return redirect(route('list_item'));
    }

    public function remove($id)
    {        
        $item = Item::find($id);
        $userid = $item->user_id;
        $user = User::find($userid);
        $senditem = new \stdClass();
        $senditem->receiver = $user->name;
        $senditem->name = $item->name;      
        Mail::to($user->email)->send(new SendMail($senditem));
        Item::find($id)->delete();
        return redirect(route('list_item'));
    }
}
