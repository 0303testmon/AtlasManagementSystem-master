@extends('layouts.sidebar')

@section('content')
    <div class="board_area w-100 border m-auto d-flex">
        <div class="post_view w-75 mt-5">
            <p class="w-75 m-auto">投稿一覧</p>
            @foreach ($posts as $post)
                <div class="post_area border w-75 m-auto p-3">
                    <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん
                    </p>
                    <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
                    <div class="post_bottom_area d-flex">
                        <div class="d-flex post_status">
                            <div class="mr-5">
                                {{-- 0901 add --}}
                                {{-- {{ dd($post) }}; --}}
                                <i class="fa fa-comment"></i>
                                @if ($post->postComments->count())
                                    <span class="">{{ $post->postComments->count() }}</span>
                                @endif
                                {{-- 0901 add --}}
                            </div>
                            <div>
                                @if (Auth::user()->is_Like($post->id))
                                    <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
                                        {{-- 0902 add --}}
                                        <span
                                            class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span>
                                    </p>
                                @else
                                    <p class="m-0"><i class="fas fa-heart like_btn"
                                            post_id="{{ $post->id }}"></i><span
                                            class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span>
                                        {{-- 0902 add --}}

                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="other_area border w-25">
            <div class="border m-4">
                <div class="btn btn-info" style="margin:5px; width:100%"><a href="{{ route('post.input') }}"
                        style="color: aliceblue">投稿</a></div>
                <div class="">
                    <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest"
                        style="background-color: #E8F0F7; border-width:thin; height:35px; border-radius:5px">
                    <input class="btn btn-info" style="color:white; " type="submit" value="検索"
                        form="postSearchRequest">
                </div>
                <input type="submit" name="like_posts" class="category_btn btn btn-pink"
                    style="background-color: #FEBAFF; color:aliceblue; margin:5px" value="いいねした投稿" form="postSearchRequest">
                <input type="submit" name="my_posts" class="category_btn btn btn-warning" style="color:white"
                    value="自分の投稿" form="postSearchRequest">
                <!-- change 20242013 >> -->

                {{-- <ul>
                    @foreach ($categories as $category)
                        <li class="main_categories" category_id="{{ $category->id }}">
                            <span class="main_categories_btn">{{ $category->main_category }}<span
                                    class="inn"></span><span>
                        </li>
                        @foreach ($category->subCategories as $sub_category)
                            {{-- サブカテゴリから id と カテゴリ名称を取り出す --}}
                {{-- <li subcategory_id={{ $sub_category->id }}>
                    &emsp;<input type="submit" name="category_word" class="category_btn"
                        value="{{ $sub_category->sub_category }}" form="postSearchRequest">
                </li>
                @endforeach
                @endforeach
                </ul>  --}}
                <!-- change 20242013 << -->
                <lavel></lavel>
                <label>カテゴリー検索</label>
                <ul>
                    @foreach ($categories as $category)
                        <li class="main_categories" category_id="{{ $category->id }}">
                            <span class="main_categories_btn is-open" style="color: black; text-decolation:underline"
                                id="{{ $category->id }}">{{ $category->main_category }}<span class="inn"></span><span>
                        </li>
                        <div class="category_num{{ $category->id }} is-open">
                            @foreach ($category->subCategories as $sub_category)
                                {{-- サブカテゴリから id と カテゴリ名称を取り出す --}}
                                <li subcategory_id={{ $sub_category->id }}>
                                    &emsp;<input type="submit" name="category_word" class="category_btn"
                                        value="{{ $sub_category->sub_category }}" form="postSearchRequest">
                                </li>
                            @endforeach
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
        <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
    </div>
@endsection
