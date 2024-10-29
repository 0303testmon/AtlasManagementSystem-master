<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectNameDetails implements DisplayUsers{

  // 改修課題：選択科目の検索機能
  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects){
    if(is_null($gender)){
      $gender = ['1', '2', '3'];
    }else{
      $gender = array($gender);
    }
    if(is_null($role)){
      $role = ['1', '2', '3', '4'];
    }else{
      $role = array($role);
    }
    // 0825 add
    if(is_null($subjects)){
      $subjects = ['1', '2', '3'];
    }else{
        // 1027 add >>
      // $subjects = array($subjects);
      $subjects = $subjects;
      // 1027 add <<
    }
    // 0825 add
    $users = User::with('subjects')
    ->where(function($q) use ($keyword){
      $q->Where('over_name', 'like', '%'.$keyword.'%')
      ->orWhere('under_name', 'like', '%'.$keyword.'%')
      ->orWhere('over_name_kana', 'like', '%'.$keyword.'%')
      ->orWhere('under_name_kana', 'like', '%'.$keyword.'%');
    })
    ->where(function($q) use ($role, $gender){
      $q->whereIn('sex', $gender)
      ->whereIn('role', $role);
    })
    // 0824 add
    ->whereHas('subjects', function($q) use ($subjects){
      $q->wherein('subjects.id', $subjects);
    // 0824 add
    })
    ->orderBy('over_name_kana', $updown)->get();
    return $users;
  }

}
