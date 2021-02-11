<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    // micropostsの情報とつなぐ　追記
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    
    // Follow　する側　=　$user が Followしている User 達を取得
    public function followings()
    {
        return $this->belongsToMany
        (User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
        // 第一引数に得られる Model Class(User::class) を指定し、
        // 第二引数に中間Table (user_follow) を指定し、
        // 第三引数に中間Tableに保存されている自分の id を示すColumn名 (user_id) を指定し、
        
        // 第四引数に中間Tableに保存されている関係先の id を示すColumn名 (follow_id) を指定
        
        // user_id のUser は follow_id の User をFollow　している

    }

    // Follow　されている側　=$user をフォローしている User 達を取得
    public function followers()
    {
        return $this->belongsToMany
        (User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
        // 第一引数に得られる Model Class(User::class) を指定し、
        // 第二引数に中間Table (user_follow) を指定し、
        
        // 第三引数に中間Tableに保存されている関係先の id を示すColumn名 (follow_id) を指定
        // followings()の　三　と　四　の逆
        // 第四引数に中間Tableに保存されている自分の id を示すColumn名 (user_id) を指定し、
        
        // follow_id のUser は user_id の User からFolloW　されている
    }
    
    
     public function follow($userId)
    {
        // 既にFollowしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 既にFollowしていれば何もしない
            return false;
        } else {
            // 未FollowであればFollowする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    
}



