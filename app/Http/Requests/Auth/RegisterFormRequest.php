<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected $redirect = '/register';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'over_name' => 'required | string | max:10',
            'under_name' => 'required | string | max:10',
            'over_name_kana' => 'required | string | regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u | max:30',
            'under_name_kana' => 'required | string | regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u | max:30',
            'mail_address'=>'required|email|unique:users|max:100',
            'sex' => 'required' ,
            'old_year'=>'required|after:2000|before:2024',
            'old_month'=>'required',
            'old_day'=>'required',
            // 'old_day'=>'required|after:1|before:31',
            'role' => 'required' ,
            'password'=>'required|between:8,30|same:password'
        ];
    }

    public function messages(){
        return [
            'over_name.max' => '10文字以内で入力してください',
            'under_name.max' => '10文字以内で入力してください',
            'over_name_kana.regex' => 'カタカナで入力してください',
            'over_name_kana.max' => '30文字以内で入力してください',
            'under_name_kana.regex' => 'カタカナで入力してください',
            'under_name_kana.max' => '30文字以内で入力してください',
            'mail_address.email'=>'メールアドレスの形式で入力してください',
            'mail_address.unique'=>'すでに登録されています',
            'mail_address.max'=>'100文字以内で入力してください',
            'old_year.after'=>'2000年以上を指定してください',
            'old_year.before'=>'2024年以下を指定してください',
            // 'old_day.after'=>'1日以上を指定してください',
            // 'old_day.before'=>'31日以下を指定してください',
            'password.between'=>'8～30文字の間で入力してください',
            'password.same'=>'確認用パスワードが間違っています',
        ];
    }
}
