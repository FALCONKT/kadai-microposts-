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
        
        // microposts 追加時 を追加
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        // 変数として$data を追加
        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];
        
        $data += $this->counts($user);


        // 元の内容を改変
        return view('users.show', $data);
    }
}
