<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>

<body style="background-color:#E8F0F7">
    <form action="{{ route('loginPost') }}" method="POST">
        <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
            {{-- 1012 add --}}
            <div class="container text-center">
                <div class="row">
                    <div class="col w-50 vh-50">
                        <img src="/image/atlas-black.png" style="align-items:center; justify-content:center;"
                            width="200" height="80">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        {{-- <div class="border vh-50 w-25"> --}}
                        <div
                            style="border: 1px solid #cccccc; margin-top:40px; padding-bottom:20px; box-shadow: 4px 4px 8px #dddddd; border-radius: 10px; background-color:white">
                            <div class="w-75 m-auto pt-5">
                                <label class="d-block m-0" style="font-size:13px;">メールアドレス</label>
                                <div class="border-bottom border-primary w-100">
                                    <input type="text" class="w-100 border-0" name="mail_address">
                                </div>
                            </div>
                            <div class="w-75 m-auto pt-5">
                                <label class="d-block m-0" style="font-size:13px;">パスワード</label>
                                <div class="border-bottom border-primary w-100">
                                    <input type="password" class="w-100 border-0" name="password">
                                </div>
                            </div>
                            <div class="text-right m-3">
                                <input type="submit" class="btn btn-primary" value="ログイン">
                            </div>
                            <div class="text-center">
                                <a href="{{ route('registerView') }}">新規登録はこちら</a>
                            </div>
                            {{ csrf_field() }}
                        </div>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</body>

</html>
