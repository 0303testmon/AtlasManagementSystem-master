@extends('layouts.sidebar')

@section('content')
    <p>ユーザー検索</p>
    <div class="search_content w-100 border d-flex">
        <div class="reserve_users_area">
            @foreach ($users as $user)
                <div class="border one_person"
                    style="box-shadow: 4px 4px 8px #dddddd; border-radius: 10px; margin:5px; padding:5px;  background-color:white">
                    <div>
                        <span>ID : </span><span>{{ $user->id }}</span>
                    </div>
                    <div><span>名前 : </span>
                        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                            <span>{{ $user->over_name }}</span>
                            <span>{{ $user->under_name }}</span>
                        </a>
                    </div>
                    <div>
                        <span>カナ : </span>
                        <span>({{ $user->over_name_kana }}</span>
                        <span>{{ $user->under_name_kana }})</span>
                    </div>
                    <div>
                        @if ($user->sex == 1)
                            <span>性別 : </span><span>男</span>
                        @elseif($user->sex == 2)
                            <span>性別 : </span><span>女</span>
                        @else
                            <span>性別 : </span><span>その他</span>
                        @endif
                    </div>
                    <div>
                        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
                    </div>
                    <div>
                        @if ($user->role == 1)
                            <span>権限 : </span><span>教師(国語)</span>
                        @elseif($user->role == 2)
                            <span>権限 : </span><span>教師(数学)</span>
                        @elseif($user->role == 3)
                            <span>権限 : </span><span>講師(英語)</span>
                        @else
                            <span>権限 : </span><span>生徒</span>
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
                                    <span value={{ $subject->id }}>{{ $subject->subject }}</span>
                                @endforeach
                                {{-- 0812 add --}}
                        @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="search_area w-25 border">
            <div class="">
                <div>
                    <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
                </div>
                <div>
                    <lavel>カテゴリ</lavel>
                    <select form="userSearchRequest" name="category">
                        <option value="name">名前</option>
                        <option value="id">社員ID</option>
                    </select>
                </div>
                <div>
                    <label>並び替え</label>
                    <select name="updown" form="userSearchRequest">
                        <option value="ASC">昇順</option>
                        <option value="DESC">降順</option>
                    </select>
                </div>
                <div class="">
                    <span class="m-0 search_conditions_btn"><span>検索条件の追加<span class="inn"></span></span></span>
                    <div class="search_conditions_inner">
                        <div>
                            <label>性別</label>
                            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
                            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
                            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
                        </div>
                        <div>
                            <label>権限</label>
                            <select name="role" form="userSearchRequest" class="engineer">
                                <option selected disabled>----</option>
                                <option value="1">教師(国語)</option>
                                <option value="2">教師(数学)</option>
                                <option value="3">教師(英語)</option>
                                <option value="4" class="">生徒</option>
                            </select>
                        </div>
                        <div type='checkbox' class="selected_engineer">
                            <label>選択科目</label>
                            {{-- 0824 add --}}
                            <p class="m-0 p-0"><label>国語</label><input type="checkbox" name="subject[]" value="1"
                                    form="userSearchRequest"></p>
                            <p class="m-0 p-0"><label>数学</label><input type="checkbox" name="subject[]" value="2"
                                    form="userSearchRequest"></p>
                            <p class="m-0 p-0"><label>英語</label><input type="checkbox" name="subject[]" value="3"
                                    form="userSearchRequest"></p>
                            {{-- 0824 add --}}
                        </div>
                    </div>
                </div>
                <div>
                    <input type="reset" value="リセット" form="userSearchRequest">
                </div>
                <div>
                    <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
                </div>
            </div>
            <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
        </div>
    </div>
@endsection
