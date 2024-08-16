<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    // 0812 add 選択科目表示
        // subject to user belongsToMany("モデル", "相手のテーブル", "自分の外部キー", "相手の外部キー")
    public function users(){
        // リレーションの定義
        return $this->belongsToMany('App\Models\Users\User', 'subject_users', 'subject_id', 'user_id')->withPivot('id');
        // return $this->belongsToMany('App\Models\Users\User');
    }
    // 0812 add


}
