<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory(){
        // リレーションの定義
        // 20240713 add >>
        return $this->belongsTo('App\Models\Categories\MainCategory');
        // 20240713 add <<
    }

    public function posts(){
        // リレーションの定義
        // 20240713 add >>
        return $this->hasMany('App\Models\Posts\Post');
        // 20240713 add <<
    }
}
