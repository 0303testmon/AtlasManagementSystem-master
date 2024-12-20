<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_category_id' => 'required',
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
            // 'post_title' => 'string|min:1|max:100',
            // 'post_body' => 'string|min:1|max:5000',



        ];
    }

    public function messages(){
        return [
            // 'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            'post_title.string' => '文字列で入力してください。',
            'post_title.required' => '必須項目です。',
            // 'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.max' => '最大文字数は5000文字です。',
            'post_body.string' => '文字列で入力してください。',
            'post_body.required' => '必須項目です。',

            // 'sub_category_name.max' => '最大文字数は100文字です。',
            // 'sub_category_name.string' => '文字列で入力してください。',
            // 'sub_category_name.required' => 'サブカテゴリーは必ず入力してください。',
            // 'sub_category_name.unique' => 'すでに登録されています。',
        ];
    }
}
