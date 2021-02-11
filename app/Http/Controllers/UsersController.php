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
        
        // $data にCountが増えると現在のid に$dataの内容を足す　
        $data += $this->counts($user);
        

        // 元の内容を改変
        return view('users.show', $data);
    }
    
    // Followしている
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    // Followされている
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
    
    
}
