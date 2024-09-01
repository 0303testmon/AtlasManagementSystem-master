<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
    }

    // 0901 add いいねしてるかどうか
        public function post(){
        return $this->belongsTo('App\Models\Posts\Post');
    }
    public function user(){
    return $this->belongsTo('App\Models\Users\User');
    }
    // 0901 add いいねしてるかどうか

}
