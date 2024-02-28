<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
    <style>
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            background: #f5f5f5;
            padding: 0;
            margin: 0;
        }

        i.fa {
            font-size: 16px;
        }

        p {
            font-size: 16px;
            line-height: 1.428571429;
        }

        .header {
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
            background: #3498DB;
            width: 100%;
            height: 50px;
            line-height: 50px;
            color: #fff;
        }

        .header .logo {
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header #menu-action {
            display: block;
            float: left;
            width: 60px;
            height: 50px;
            line-height: 50px;
            margin-right: 15px;
            color: #fff;
            text-decoration: none;
            text-align: center;
            background: rgba(0, 0, 0, 0.15);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .header #menu-action i {
            display: inline-block;
            margin: 0 5px;
        }

        .header #menu-action span {
            width: 0px;
            display: none;
            overflow: hidden;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .header #menu-action:hover {
            background: rgba(0, 0, 0, 0.25);
        }

        .header #menu-action.active {
            width: 250px;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .header #menu-action.active span {
            display: inline;
            width: auto;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .sidebar {
            position: fixed;
            z-index: 10;
            left: 0;
            top: 50px;
            height: 100%;
            width: 60px;
            background: #fff;
            border-right: 1px solid #ddd;
            text-align: center;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .sidebar:hover,
        .sidebar.active,
        .sidebar.hovered {
            width: 250px;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            display: block;
        }

        .sidebar ul li a {
            display: block;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
            border-bottom: 1px solid #ddd;
            color: #444;
            text-align: left;
        }

        .sidebar ul li a i {
            display: inline-block;
            width: 60px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            -webkit-animation-duration: .7s;
            -moz-animation-duration: .7s;
            -o-animation-duration: .7s;
            animation-duration: .7s;
            -webkit-animation-fill-mode: both;
            -moz-animation-fill-mode: both;
            -o-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .sidebar ul li a span {
            display: inline-block;
            height: 60px;
            line-height: 60px;
        }

        .sidebar ul li a:hover {
            background-color: #eee;
        }

        .main {
            position: relative;
            display: block;
            top: 50px;
            left: 0;
            padding: 15px;
            padding-left: 75px;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .main.active {
            padding-left: 275px;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .main .jumbotron {
            background-color: #fff;
            padding: 30px !important;
            border: 1px solid #dfe8f1;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        .main .jumbotron h1 {
            font-size: 24px;
            margin: 0;
            padding: 0;
            margin-bottom: 12px;
        }

        @-webkit-keyframes swing {
            20% {
                -webkit-transform: rotate3d(0, 0, 1, 15deg);
                transform: rotate3d(0, 0, 1, 15deg);
            }

            40% {
                -webkit-transform: rotate3d(0, 0, 1, -10deg);
                transform: rotate3d(0, 0, 1, -10deg);
            }

            60% {
                -webkit-transform: rotate3d(0, 0, 1, 5deg);
                transform: rotate3d(0, 0, 1, 5deg);
            }

            80% {
                -webkit-transform: rotate3d(0, 0, 1, -5deg);
                transform: rotate3d(0, 0, 1, -5deg);
            }

            100% {
                -webkit-transform: rotate3d(0, 0, 1, 0deg);
                transform: rotate3d(0, 0, 1, 0deg);
            }
        }

        @keyframes swing {
            20% {
                -webkit-transform: rotate3d(0, 0, 1, 15deg);
                -ms-transform: rotate3d(0, 0, 1, 15deg);
                transform: rotate3d(0, 0, 1, 15deg);
            }

            40% {
                -webkit-transform: rotate3d(0, 0, 1, -10deg);
                -ms-transform: rotate3d(0, 0, 1, -10deg);
                transform: rotate3d(0, 0, 1, -10deg);
            }

            60% {
                -webkit-transform: rotate3d(0, 0, 1, 5deg);
                -ms-transform: rotate3d(0, 0, 1, 5deg);
                transform: rotate3d(0, 0, 1, 5deg);
            }

            80% {
                -webkit-transform: rotate3d(0, 0, 1, -5deg);
                -ms-transform: rotate3d(0, 0, 1, -5deg);
                transform: rotate3d(0, 0, 1, -5deg);
            }

            100% {
                -webkit-transform: rotate3d(0, 0, 1, 0deg);
                -ms-transform: rotate3d(0, 0, 1, 0deg);
                transform: rotate3d(0, 0, 1, 0deg);
            }
        }

        .swing {
            -webkit-transform-origin: top center;
            -ms-transform-origin: top center;
            transform-origin: top center;
            -webkit-animation-name: swing;
            animation-name: swing;
        }

        .bs-callout {
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #eee;
            border-left-width: 5px;
            border-radius: 3px;
            background: white;
        }

        table {
            background: white;
        }

        .bs-callout h4 {
            margin-top: 0;
            margin-bottom: 5px;
        }

        .bs-callout p:last-child {
            margin-bottom: 0;
        }

        .bs-callout code {
            border-radius: 3px;
        }

        .bs-callout+.bs-callout {
            margin-top: -5px;
        }

        .bs-callout-default {
            border-left-color: #777;
        }

        .bs-callout-default h4 {
            color: #777;
        }

        .bs-callout-primary {
            border-left-color: #428bca;
        }

        .bs-callout-primary h4 {
            color: #428bca;
        }

        .bs-callout-success {
            border-left-color: #5cb85c;
        }

        .bs-callout-success h4 {
            color: #5cb85c;
        }

        .bs-callout-danger {
            border-left-color: #d9534f;
        }

        .bs-callout-danger h4 {
            color: #d9534f;
        }

        .bs-callout-warning {
            border-left-color: #f0ad4e;
        }

        .bs-callout-warning h4 {
            color: #f0ad4e;
        }

        .bs-callout-info {
            border-left-color: #5bc0de;
        }

        .bs-callout-info h4 {
            color: #5bc0de;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="#" id="menu-action" class="active" >
            <i class="fa fa-times"></i>
            <span>Close</span>
        </a>
        <div class="logo d-flex justify-content-between align-items-center px-3">
            <div>{{ Auth::user()->name }}</div>
            <div><a href="{{ route('logout') }}" class="text-white"><i class="fa fa-sign-out-alt"></i> </a></div>
        </div>
    </div>
    <div class="sidebar active">
        <ul>
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-desktop"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('profile.refer') }}"><i class="fa fa-share"></i><span>Refer</span></a></li>
            <li><a href="{{ route('profile.edit') }}"><i class="fa fa-user"></i><span>Profile</span></a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out-alt"></i><span>Logout</span></a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="main active">
       <div class="container-fluid">
        @yield('content')
       </div>
    </div>
    <script>
        $('#menu-action').click(function() {
            $('.sidebar').toggleClass('active');
            $('.main').toggleClass('active');
            $(this).toggleClass('active');

            if ($('.sidebar').hasClass('active')) {
                $(this).find('i').removeClass('fa-close');
                $(this).find('i').addClass('fa-bars');
            } else {
                $(this).find('i').removeClass('fa-bars');
                $(this).find('i').addClass('fa-close');
            }
        });

        // Add hover feedback on menu
        $('#menu-action').hover(function() {
            $('.sidebar').toggleClass('hovered');
        });
    </script>

@stack('custom_js')
</body>

</html>
