<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farbod News - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body{
            background-image: url('https://s6.uupload.ir/files/illuminati-purple-triangle-6mvxd7mkrukji37p-6mvxd7mkrukji37p_3opv.jpg');
            background-size: cover;
        }
    </style>
</head>
<body style="direction: @yield('style')">
<div class="d-flex flex-column flex-md-row align-items-center p-2 border-buttom shadow-sm mb-3" style="background-color: black; justify-content: space-between;">
    <div>
        <a href="http://127.0.0.1:8000/" style="float:right; padding-top:10px"><img src="https://s6.uupload.ir/files/1_puh7.jpg" alt="Logo" class="img-fluid rounded-circle" width="100" height="100"></a>
        <a href="{{ route('home.index') }}" class="text-dark" style="text-decoration: none"><h5 class="my-0 mr-md-auto font-weight-normal" style="font-size: 50px;padding-bottom:10px; color: white; float: right; padding-right:5px">سایت تحقیقاتی فربد</h5></a>
    </div>
    <div style="font-size:20px;">
    @guest
        <nav class="my-2 my-md-0 mr-md-3 align-items-left">
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="p-3" style="text-decoration: none; color: white; float:right">عضویت</a>
        @endif
        <a href="{{ route('login') }}" class="p-3" style="text-decoration: none; color: white; float:left">ورود</a>
        </nav>
    @else
        <nav class="my-2 my-md-0 mr-md-3 align-items-left">
            @can('admin')
                <a href="{{ route('news.create') }}" class="p-3" style="text-decoration: none; color: white; float: right;">ثبت تاپیک جدید</a>
                <a href="{{ route('user.index') }}" class="p-3" style="text-decoration: none; color: white; float: right;">کاربر ها</a>
            @endcan
            @can('user')
            <a href="http://127.0.0.1:8000/request-topic" class="p-3" style="text-decoration: none; color: white; float: right;">درخواست ثبت تاپیک جدید</a>
            @endcan
        <a href="{{ route('logout') }}" class="p-3" style="text-decoration: none; color: white; float:right;"
        onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج({{ Auth::user()->name }})</a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
            style="display: none";>
            @csrf
        </form>
    
                <a href="http://127.0.0.1:8000/profile"><img src="https://s6.uupload.ir/files/download_(1)_iy.png" alt="Logo" class="img-fluid rounded-circle" width="60" height="60" style="padding-top:0px"></a>
    @endguest
    </nav>
</div>
</div>

    <div class="container" style="height:85vh">
        @if (session('status'))
            <div style="width: 100%;">            
                <div class="alert alert-success" style="width: fit-content;font-size:30px; padding:5px; background-color:red">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        @yield('content')
    </div>
</body>

     @yield('scripts')
</html>