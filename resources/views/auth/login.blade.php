<!DOCTYPE html>
<html>

<head>

    <!-- Title -->
    <title>G.C | Login - Grau Certo</title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="{{asset('plugin/plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet" />
    <link href="{{asset('plugin/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/line-icons/simple-line-icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/offcanvasmenueffects/css/menu_cornerbox.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/waves/waves.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/3d-bold-navigation/css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme Styles -->
    <link href="{{asset('plugin/css/modern.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/css/themes/green.css')}}" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/css/custom.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('plugin/plugins/3d-bold-navigation/js/modernizr.js')}}"></script>
    <script src="{{asset('plugin/plugins/offcanvasmenueffects/js/snap.svg-min.js')}}"></script>

    <!-- Logo pequeno  -->
    <link rel="shortcut icon" href="{{asset('imagens/grau_certo_logo.jpg')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body class="page-login">
    <main class="page-content">
        <div class="page-inner">
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-3 center">
                        <div class="login-box">
                            <a href="index.html" class="logo-name text-lg text-center">Sistema Help</a>
                            <p class="text-center m-t-md">Por favor, Entre no sistema.</p>
                            <form class="m-t-md" action="{{ url('auth/check') }}" method="post">
                                @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                @endif

                                @csrf <!-- {{ csrf_field() }} -->
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>

                                <button type="submit" class="btn btn-success btn-block">Login</button>
                                <!--
                                <a href="forgot.html" class="display-block text-center m-t-md text-sm">Forgot Password?</a>
                                <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                <a href="register.html" class="btn btn-default btn-block m-t-md">Create an account</a>
                                 -->
                            </form>
                            <p class="text-center m-t-xs text-sm">2023 &copy; Grau Certo.</p>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
        </div><!-- Page Inner -->
    </main><!-- Page Content -->


    <!-- Javascripts -->
    <script src="{{asset('plugin/plugins/jquery/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/pace-master/pace.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
    <script src="{{asset('plugin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/uniform/jquery.uniform.min.js')}}"></script>
    <script src="{{asset('plugin/plugins/offcanvasmenueffects/js/classie.js')}}"></script>
    <script src="{{asset('plugin/plugins/waves/waves.min.js')}}"></script>
    <script src="{{asset('plugin/js/modern.min.js')}}"></script>

</body>

</html>
