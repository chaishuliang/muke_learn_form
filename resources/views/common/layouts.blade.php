<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>轻松学会Laravel - @yield('title')</title>
    <!-- Bootstrap CSS 文件 -->
    <link rel="stylesheet" href="{{ asset('static/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/base.css') }}">
    @section('style')

    @show
</head>
<body>

<!-- 头部 -->
@section('header')
    {{--<div class="jumbotron">
        <div class="container">
            <h2>轻松学会Laravel</h2>

            <p> - 玩转Laravel表单</p>
        </div>
    </div>--}}
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/student/index') }}">表单</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@show

<!-- 中间内容区局 -->
<div id="main" class="container">
    <div class="row">

        <!-- 左侧菜单区域   -->
        <div class="col-md-3">
            @section('leftmenu')
                <div class="list-group">
                    <a href="{{ url('student/index') }}" class="list-group-item
                    {{ Request::getPathInfo() != '/student/create' ? 'active' : '' }}
                    ">学生列表</a>
                    <a href="{{ url('student/create') }}" class="list-group-item
                    {{ Request::getPathInfo() == '/student/create' ? 'active' : '' }}
                    ">新增学生</a>
                </div>
            @show
        </div>

        <!-- 右侧内容区域 -->
        <div class="col-md-8">

           @yield('content')

        </div>
    </div>
</div>

<!-- 尾部 -->
@section('footer')
    <footer id="footer" class="footer jumbotron">
        <div class="container">
            <div class="text-center">{{ "@".date('Y') }} imooc</div>
        </div>
    </footer>
@show

<!-- jQuery 文件 -->
<script src="{{ asset('static/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap JavaScript 文件 -->
<script src="{{ asset('static/bootstrap/js/bootstrap.min.js') }}"></script>

@section('javascript')

@show

</body>
</html>