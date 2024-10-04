<?php
namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  function pastClassName(){
    return;
  }

  /**
   * @return
   */

   function render(){
     return '<p class="day">' . $this->carbon->format("j"). '日</p>';
   }

   function selectPart($ymd){
     $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
     $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
     $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();
     if($one_part_frame){
       $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first()->limit_users;
     }else{
       $one_part_frame = '0';
     }
     if($two_part_frame){
       $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first()->limit_users;
     }else{
       $two_part_frame = '0';
     }
     if($three_part_frame){
       $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first()->limit_users;
     }else{
       $three_part_frame = '0';
     }

     $html = [];
    //  0908 add
     $toDay = $this->carbon->today()->format("Y-m-d");
     if($toDay >= $ymd){
      $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="" disabled>受付終了</button>';
      $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
     }else{
      $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts">';
     $html[] = '<option value="" selected></option>';
     if($one_part_frame == "0"){
       $html[] = '<option value="1" disabled>リモ1部(残り0枠)</option>';
     }else{
       $html[] = '<option value="1">リモ1部(残り'.$one_part_frame.'枠)</option>';
     }
     if($two_part_frame == "0"){
       $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';
     }else{
       $html[] = '<option value="2">リモ2部(残り'.$two_part_frame.'枠)</option>';
     }
     if($three_part_frame == "0"){
       $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';
     }else{
       $html[] = '<option value="3">リモ3部(残り'.$three_part_frame.'枠)</option>';
     }
     $html[] = '</select>';
    }

    // 0921 add
    // $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" data-toggle="modal" data-target="#deleteModal' . $day->authReserveDate($day->everyDay())->first()->setting_part . '" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
    // $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
    // $html[] = '<div class="modal fade" id="deleteModal' .  . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    // <div class="modal-dialog" role="document">
    // <div class="modal-content">
    // <div class="modal-body">';
    // $html[] = '予約日 : ' . $reservePart . '<br>時間 : ' . $reservePart . '<br>';
    // $html[] = '上記の予約をキャンセルしてもよろしいですか？</div>
    // <div class="modal-footer">
    // <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
    // <button type="button" class="btn btn-primary">キャンセル</button>
    // </div>
    // </div></div></div>';
    // 0921 add


    // //  0905 add
    // //  $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts">';
    //  $toDay = $this->carbon->today()->format("Y-m-d");
    //  if($toDay >= $ymd){
    //   $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts" disabled>';
    //  }else{
    //   $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts">';
    //  }
    // //  0905 add
    //  $html[] = '<option value="" selected></option>';
    //  if($one_part_frame == "0"){
    //    $html[] = '<option value="1" disabled>リモ1部(残り0枠)</option>';
    //  }else{
    //    $html[] = '<option value="1">リモ1部(残り'.$one_part_frame.'枠)</option>';
    //  }
    //  if($two_part_frame == "0"){
    //    $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';
    //  }else{
    //    $html[] = '<option value="2">リモ2部(残り'.$two_part_frame.'枠)</option>';
    //  }
    //  if($three_part_frame == "0"){
    //    $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';
    //  }else{
    //    $html[] = '<option value="3">リモ3部(残り'.$three_part_frame.'枠)</option>';
    //  }
    //  $html[] = '</select>';
     return implode('', $html);
   }

   function getDate(){
     return '<input type="hidden" value="'. $this->carbon->format('Y-m-d') .'" name="getData[]" form="reserveParts">';
   }

   function everyDay(){
     return $this->carbon->format('Y-m-d');
   }

   function authReserveDay(){
     return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
   }

   function authReserveDate($reserveDate){
     return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
   }


}
