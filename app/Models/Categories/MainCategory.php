<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    public function subCategories(){
        // リレーションの定義
        // 20240713 add >>
        return $this->hasMany('App\Models\Categories\SubCategory', 'main_category_id', 'id');
        // 20240713 add <<
    }

}
