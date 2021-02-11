<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    // counts() が使用可能。全てのControllerが Controller.php を継承しているため
    public function counts($user) {

        // micropostsの計上
        $count_microposts = $user->microposts()->count();

        // Folloｗ／Foloower数のCountを View で表示する機能
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();

        return [
            // micropostsの計上
            'count_microposts' => $count_microposts,
            
            // Folloｗ／Foloower数のCountを View で表示する機能
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
        ];
    }
    
    
    
    
}
