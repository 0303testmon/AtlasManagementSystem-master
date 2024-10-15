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
                    {{-- 1015 add --}}
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 1015 add --}}

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

                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

@endsection
