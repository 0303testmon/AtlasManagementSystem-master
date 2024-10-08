<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

        // 0926 add
    public function delete(Request $request){
        // dd($request->partId);
        // ユーザ取得
        $user_id = Auth::id();
        $user = User::find($user_id);
        // ユーザの予約取得
        $reserveSettings = $user->reserveSettings()->wherePivot('reserve_setting_id', $request->partId)->get();
        // 対象の中間テーブルデータ削除
        $user->reserveSettings()->detach($request->partId);
        // 上限のインクリメント
        $reserve_settings = ReserveSettings::where('id', $request->partId)->first();
        $reserve_settings->increment('limit_users');

        return redirect()->route('calendar.general.show',['user_id' => Auth::id()]);
    }
}
