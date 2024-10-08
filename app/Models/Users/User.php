<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Posts\Like;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use softDeletes;

    const CREATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'over_name',
        'under_name',
        'over_name_kana',
        'under_name_kana',
        'mail_address',
        'sex',
        'birth_day',
        'role',
        'password'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Models\Posts\Post');
    }
    // 0901 add コメントしてるかどうか
    public function postComments(){
    return $this->hasMany('App\Models\Posts\PostComment');
    }
    // 0901 add コメントしてるかどうか

    // 0901 add いいねしてるかどうか
    public function Likes(){
    return $this->hasMany('App\Models\Posts\Like');
    }
    // 0901 add いいねしてるかどうか

    public function calendars(){
        return $this->belongsToMany('App\Models\Calendars\Calendar', 'calendar_users', 'user_id', 'calendar_id')->withPivot('user_id', 'id');
    }

    public function reserveSettings(){
        return $this->belongsToMany('App\Models\Calendars\ReserveSettings', 'reserve_setting_users', 'user_id', 'reserve_setting_id')->withPivot('id');
    }

    // user to role belongsToMany("モデル", "相手のテーブル", "自分の外部キー", "相手の外部キー")
    public function subjects(){
        // -- 20240713 add >>
        return $this->belongsToMany('App\Models\Users\Subjects', 'subject_users', 'user_id', 'subject_id')->withPivot('id');
        // 20230713 add <<
        // リレーションの定義
    }

    // いいねしているかどうか
    public function is_Like($post_id){
        return Like::where('like_user_id', Auth::id())->where('like_post_id', $post_id)->first(['likes.id']);
    }

    public function likePostId(){
        return Like::where('like_user_id', Auth::id());
    }

    // 0812 add 選択科目表示
        public function subject(){
        // return $this->hasMany('App\Models\Users\Subjects');
        return $this->belongsToMany('App\Models\Users\Subjects')->withPivot('id');
        // return $this->belongsToMany('App\Models\Users\Subjects')->withPivot('id');
    // 0812 add
    }
}
