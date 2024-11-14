@extends('layouts.sidebar')

@section('content')
    <div class="search_content w-100 border d-flex">
        <div class="reserve_users_area">
            @foreach ($users as $user)
                <div class="border one_person"
                    style="box-shadow: 4px 4px 8px #dddddd; border-radius: 10px; margin:5px; padding:5px;  background-color:white">
                    <div>
                        <span>ID : </span><span><b>{{ $user->id }}</b></span>
                    </div>
                    <div><span>名前 : </span>
                        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                            <b><span>{{ $user->over_name }}</span>
                                <span>{{ $user->under_name }}</span></b>
                        </a>
                    </div>
                    <div>
                        <span>カナ : </span>
                        <b><span>({{ $user->over_name_kana }}</span>
                            <span>{{ $user->under_name_kana }})</span></b>
                    </div>
                    <div>
                        @if ($user->sex == 1)
                            <span>性別 : </span><span><b>男</b></span>
                        @elseif($user->sex == 2)
                            <span>性別 : </span><span><b>女</b></span>
                        @else
                            <span>性別 : </span><span><b>その他</b></span>
                        @endif
                    </div>
                    <div>
                        <span>生年月日 : </span><span><b>{{ $user->birth_day }}</b></span>
                    </div>
                    <div>
                        @if ($user->role == 1)
                            <span>権限 : </span><span><b>教師(国語)</b></span>
                        @elseif($user->role == 2)
                            <span>権限 : </span><span><b>教師(数学)</b></span>
                        @elseif($user->role == 3)
                            <span>権限 : </span><span><b>講師(英語)</b></span>
                        @else
                            <span>権限 : </span><span><b>生徒</b></span>
                        @endif
                    </div>
                    <div>
                        @if ($user->role == 4)
                            <span>選択科目 :
                                {{-- 0812 add --}}
                                {{-- ユーザーと選択科目のリレーション --}}
                                @foreach ($user->subjects as $subject)
                                    {{-- {{ dd($subject) }}; --}}
                                    {{-- subjectから id と 選択科目名称を取り出す --}}
                                    <span value={{ $subject->id }}><b>{{ $subject->subject }}</b></span>
                                @endforeach
                                {{-- 0812 add --}}
                        @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="search_area w-25 border">
            <div class="" style="padding-top: 50px">
                <div>
                    <lavel style="color: #6c757d;"><b>検索</b></lavel><br>
                    <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest"
                        style="background-color: #E6E6E6; border: none; height:50px; width:80%; border-radius: 10px; ">
                </div>
                <div>
                    <lavel style="color: #6c757d;"><b>カテゴリ</b></lavel><br>
                    <select form="userSearchRequest" name="category"
                        style="background-color: #E6E6E6; border: none; height:30px; width:30%; border-radius: 10px; ">
                        <option value="name">名前</option>
                        <option value="id">社員ID</option>
                    </select>
                </div>
                <div>
                    <label style="color: #6c757d;"><b>並び替え</b></label><br>
                    <select name="updown" form="userSearchRequest"
                        style="background-color: #E6E6E6; border: none; height:30px; width:30%; border-radius: 10px; ">
                        <option value="ASC">昇順</option>
                        <option value="DESC">降順</option>
                    </select>
                </div>
                <div class="" style="margin-top: 10px; ">
                    <span class="m-0 search_conditions_btn" style="border-bottom: medium solid #C5C5C5"><span
                            style="color: #6c757d;"><b style="font-size: 15px; ">検索条件の追加</b><span
                                class="inn"></span></span></span>
                    <div class="search_conditions_inner">
                        <div>
                            <label style="color: #6c757d; margin-top:15px"><b>性別</b></label><br>
                            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
                            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
                            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
                        </div>
                        <div>
                            <label style="color: #6c757d; margin-top:15px"><b>権限</b></label><br>
                            <select name="role" form="userSearchRequest" class="engineer"
                                style="background-color: #E6E6E6; border: none; height:30px; width:30%; border-radius: 10px; ">
                                <option selected disabled>----</option>
                                <option value="1">教師(国語)</option>
                                <option value="2">教師(数学)</option>
                                <option value="3">教師(英語)</option>
                                <option value="4" class="">生徒</option>
                            </select>
                        </div>
                        <div type='checkbox' class="selected_engineer">
                            <label style="color: #6c757d; margin-top:15px"><b>選択科目</b></label><br>
                            {{-- 0824 add --}}
                            <span class="m-0 p-0"><label>国語</label><input type="checkbox" name="subject[]" value="1"
                                    form="userSearchRequest"></span>
                            <span class="m-0 p-0"><label>数学</label><input type="checkbox" name="subject[]" value="2"
                                    form="userSearchRequest"></span>
                            <span class="m-0 p-0"><label>英語</label><input type="checkbox" name="subject[]" value="3"
                                    form="userSearchRequest"></span>
                            {{-- 0824 add --}}
                        </div>
                    </div>
                </div>
                <div>
                    <input class="btn btn-info" style="margin:5px; width:80%" type="submit" name="search_btn"
                        value="検索" form="userSearchRequest">
                </div>
                <div>
                    <input style="margin:5px; width:80%; border:none; background-color:#E8F0F7; color:#17A2B8"
                        type="reset" value="リセット" form="userSearchRequest">
                </div>
            </div>
            <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
        </div>
    </div>
@endsection
