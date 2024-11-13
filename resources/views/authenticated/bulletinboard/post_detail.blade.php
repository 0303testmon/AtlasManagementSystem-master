@extends('layouts.sidebar')
@section('content')
    <div class="vh-100 d-flex">

        {{-- 1031 add --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="w-50 mt-5">
            <div class="m-3 detail_container">
                <div class="p-3">
                    <div class="detail_inner_head">
                        <div>
                        </div>
                        {{-- 1024 add 自分のだけ編集、削除 --}}
                        @if (Auth::user()->id == $post->user->id)
                            <div>
                                <span class="edit-modal-open" post_title="{{ $post->post_title }}"
                                    post_body="{{ $post->post }}" post_id="{{ $post->id }}"><button type="button"
                                        class="btn btn-primary">編集</button></span>
                                <a href="{{ route('post.delete', ['id' => $post->id]) }}"
                                    onclick="return confirm('削除してよろしいですか？')"><button type="button"
                                        class="btn btn-danger">削除</button></a>
                            </div>
                        @else
                            <div>
                            </div>
                        @endif
                    </div>

                    <div class="contributor d-flex">
                        <p>
                            <span>{{ $post->user->over_name }}</span>
                            <span>{{ $post->user->under_name }}</span>
                            さん
                        </p>
                        <span class="ml-5">{{ $post->created_at }}</span>
                    </div>
                    <div class="detsail_post_title">{{ $post->post_title }}</div>
                    <div class="mt-3 detsail_post">{{ $post->post }}</div>
                </div>
                <div class="p-3">
                    <div class="comment_container">
                        <span class="">コメント</span>
                        @foreach ($post->postComments as $comment)
                            <div class="comment_area border-top">
                                <p>
                                    <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
                                    <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
                                </p>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="w-50 p-3">
            <div class="comment_container border m-5">
                <div class="comment_area p-3">
                    <p class="m-0">コメントする</p>
                    <textarea class="w-100" name="comment" form="commentRequest" required></textarea>
                    <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
                    <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
                    <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <form action="{{ route('post.edit') }}" method="post">
                <div class="w-100">
                    <div class="modal-inner-title w-50 m-auto">
                        @if ($errors->first('post_title'))
                            <span class="error_message">{{ $errors->first('post_title') }}</span>
                        @endif
                        <input type="text" name="post_title" placeholder="タイトル" class="w-100">
                    </div>
                    <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
                        @if ($errors->first('post_body'))
                            <span class="error_message">{{ $errors->first('post_body') }}</span>
                        @endif
                        <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
                    </div>
                    <div class="w-50 m-auto edit-modal-btn d-flex">
                        <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
                        <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
                        <input type="submit" class="btn btn-primary d-block" value="編集">
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>

    <!-- 20241112 add >> -->
    @if ($errors->first('post_title') || $errors->first('post_body'))
        <script>
            window.onload = function() {
                $('.js-modal').fadeIn();
                var post_title = $('.edit-modal-open').attr('post_title');
                var post_body = $('.edit-modal-open').attr('post_body');
                var post_id = $('.edit-modal-open').attr('post_id');
                $('.modal-inner-title input').val(post_title);
                $('.modal-inner-body textarea').text(post_body);
                $('.edit-modal-hidden').val(post_id);
                return false;
            }
        </script>
    @endif
    <!-- 20241112 add<< -->
@endsection
