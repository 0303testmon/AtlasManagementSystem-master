<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
// 20241020 add >>
use App\Http\Requests\Auth\RegisterFormRequest;
// 20241020 add <<

use App\Models\Users\Subjects;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerView()
    {
        $subjects = Subjects::all();
        return view('auth.register.register', compact('subjects'));
    }

     // 20241021 change >>
    // public function registerPost(Request $request)
    public function registerPost(RegisterFormRequest $request)
    // 20241021 change <<
    {


         //0817 addバリデーション
        // $request->validate([
        //     'over_name' => 'required | string | max:10',
        //     'under_name' => 'required | string | max:10',
        //     'over_name_kana' => 'required | string | regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u | max:30',
        //     'under_name_kana' => 'required | string | regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u | max:30',
        //     'mail_address'=>'required|email|unique:users|max:100',
        //     'sex' => 'required' ,
        //     // 'date_field'=>'required|date|after:01/01/2000|before:08/25/2024',
        //     'old_year'=>'required|after:2000|before:2024',
        //     'old_month'=>'required',
        //     'old_day'=>'required|after:1|before:31',
        //     'role' => 'required' ,
        //     'password'=>'required|between:8,30|same:password'
        // ]);
        // 0817 add

        DB::beginTransaction();
        try{
            $old_year = $request->old_year;
            $old_month = $request->old_month;
            $old_day = $request->old_day;
            $data = $old_year . '-' . $old_month . '-' . $old_day;
            $birth_day = date('Y-m-d', strtotime($data));
            $subjects = $request->subject;
            $role = $request->role;


            $user_get = User::create([
                'over_name' => $request->over_name,
                'under_name' => $request->under_name,
                'over_name_kana' => $request->over_name_kana,
                'under_name_kana' => $request->under_name_kana,
                'mail_address' => $request->mail_address,
                'sex' => $request->sex,
                'birth_day' => $birth_day,
                'role' => $request->role,
                'password' => bcrypt($request->password)
            ]);
            $user = User::findOrFail($user_get->id);
            $user->subjects()->attach($subjects);
            DB::commit();
            return view('auth.login.login');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('loginView');
        }
    }
}
