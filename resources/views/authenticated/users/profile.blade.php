@extends('layouts.sidebar')

@section('content')
    <div class="vh-100 border">
        <div class="top_area w-75 m-auto pt-5">
            <span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
            <div class="user_status p-3">
                <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
                <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
                <p>性別 : @if ($user->sex == 1)
                    <span>男</span>@else<span>女</span>
                    @endif
                </p>
                <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
                <div>選択科目 :
                    @foreach ($user->subjects as $subject)
                        <span>{{ $subject->subject }}</span>
                    @endforeach
                </div>
                <div class="">
                    @can('admin')
                        <span class="subject_edit_btn">選択科目の編集</span>
                        <div class="subject_inner">
                            <form action="{{ route('user.edit') }}" method="post">
                                @foreach ($subject_lists as $subject_list)
                                    <div>
                                        <label>{{ $subject_list->subject }}</label>
                                        <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
                                    </div>
                                @endforeach
                                <input type="submit" value="編集" class="btn btn-primary">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                {{ csrf_field() }}
                            </form>

                            {{-- 1013 add --}}
                            {{-- <div type='checkbox' class="selected_engineer">
                                <label>選択科目</label>

                                <p class="m-0 p-0"><label>国語</label><input type="checkbox" name="subject[]" value="1"
                                        form="userSearchRequest"></p>
                                <p class="m-0 p-0"><label>数学</label><input type="checkbox" name="subject[]" value="2"
                                        form="userSearchRequest"></p>
                                <p class="m-0 p-0"><label>英語</label><input type="checkbox" name="subject[]" value="3"
                                        form="userSearchRequest"></p>

                            </div> --}}

                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

@endsection
