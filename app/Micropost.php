<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    // userの情報とつなぐ  追記
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
