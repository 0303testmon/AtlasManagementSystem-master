<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }
    //コメントしてるかどうか
    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

        //0901 add いいねしてるかどうか
    public function Likes(){
        return $this->hasMany('App\Models\Posts\Like');
    }

    public function subCategories(){
        // 20240713 add >>
        return $this->hasMany('App\Models\Categories\SubCategory');
        // 20240713 add <<
    }

    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }
}
