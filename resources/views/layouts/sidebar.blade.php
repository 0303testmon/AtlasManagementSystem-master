<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AtlasBulletinBoard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap"
        rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</head>

</head>

<body class="all_content">
    <div class="d-flex">
        <div class="sidebar">
            @section('sidebar')
                <p><a href="{{ route('top.show') }}">
                        <img src="/image/home.png" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"></img>
                        マイページ</a></p>
                <p><a href="/logout">
                        <img src="/image/logout.png" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"></img>
                        ログアウト</a></p>
                <p><a href="{{ route('calendar.general.show', ['user_id' => Auth::id()]) }}">
                        <img src="/image/karender.png" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#fff"></img>スクール予約</a></p>
                @can('admin')
                    <p><a href="{{ route('calendar.admin.show', ['user_id' => Auth::id()]) }}">
                            <img src="/image/check.png" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"></img>
                            スクール予約確認</a></p>
                    <p><a href="{{ route('calendar.admin.setting', ['user_id' => Auth::id()]) }}">
                            <img src="/image/touroku.png" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#fff"></img>
                            スクール枠登録</a></p>
                @endcan
                <p><a href="{{ route('post.show') }}">
                        <img src="/image/keijiban.png" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#fff"></img>
                        掲示板</a></p>
                <p><a href="{{ route('user.show') }}">
                        <img src="/image/user.png" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"></img>
                        ユーザー検索</a></p>
            @show
        </div>
        <div class="main-container">
            @yield('content')
        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
    {{-- 0923 add --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script> --}}

</body>

</html>
