<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    // 登録処理のみ
    public function store(Request $request, $id)
    {
        \Auth::user()->follow($id);
        return back();
    }

    // 削除処理のみ
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
