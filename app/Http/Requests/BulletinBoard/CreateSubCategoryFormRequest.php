<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubCategoryFormRequest extends FormRequest
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
            //
            'sub_category_name' => 'required|string|max:100|unique:sub_categories',
        ];
    }


       public function messages(){
        return [

            'sub_category_name.max' => '最大文字数は100文字です。',
            'sub_category_name.string' => '文字列で入力してください。',
            'sub_category_name.required' => 'サブカテゴリーは必ず入力してください。',
            'sub_category_name.unique' => 'すでに登録されています。',
        ];
    }
}
