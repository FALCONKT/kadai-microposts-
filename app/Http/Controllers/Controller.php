<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    // micropostsの計上
    // counts() が使用可能。全てのControllerが Controller.php を継承しているため
    public function counts($user) {
        $count_microposts = $user->microposts()->count();

        return [
            'count_microposts' => $count_microposts,
        ];
    }
    
    
}
