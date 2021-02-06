<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Class読み込み
use App\User; // 追加


class UsersController extends Controller
{
    //
    // User一覧
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(2);
        // paginate(1)で１つのみのPagenationへ
        
        //View user の index　を見せるようにしている
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    // User詳細を見せる
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }
}
