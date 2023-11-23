<!DOCTYPE html>
<html>

<head>

    <!-- Title -->
    <title>Syst | Grau Certo</title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Diploma Digital" />
    <meta name="keywords" content="adm,dashboard" />
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
    <link href="{{asset('plugin/plugins/switchery/switchery.min.css" rel="stylesheet')}}" type="text/css" />
    <link href="{{asset('plugin/plugins/3d-bold-navigation/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/slidepushmenus/css/component.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/weather-icons-master/css/weather-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/metrojs/MetroJs.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/datatables/css/jquery.datatables_themeroller.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="{{asset('plugin/css/modern.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/css/themes/green.css')}}" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugin/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Logo pequeno  -->
    <link rel="shortcut icon" href="{{asset('imagens/grau_certo_logo.jpg')}}">

      

    <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="{{asset('plugin/plugins/offcanvasmenueffects/js/snap.svg-min.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body class="page-header-fixed">
    <div class="overlay"></div>
    <main class="page-content content-wrap">
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="">
            <h3><span class="pull-left">.......</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
            <div class="chat-write">
                <form class="form-horizontal" action="javascript:void(0);">
                    <input type="text" class="form-control" placeholder="Say something">
                </form>
            </div>
        </nav>
        <div class="menu-wrap">
            <nav class="profile-menu">
                <div class="profile"><img src="@if (isset($logado->FOTO)) {{asset('/storage/'.$logado->FOTO)}}  @else {{asset('/imagens/user_default.png')}} @endif" width="60" alt="{{$logado->USU_LOGIN}}" /><span>{{$logado->USU_LOGIN}}</span></div>
                <div class="profile-menu-list">
                    <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a>
                    <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a>
                    <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a>
                    <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>
            <!--
                <form class="search-form" action="#" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                        </span>
                    </div>
                </form>
            -->

        <div class="navbar">
            <div class="navbar-inner">
                <div class="sidebar-pusher">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="logo-box">
                    <a href="{{url('adm/home')}}" class="logo-text"><span>Grau Certo</span></a>
                </div><!-- Logo Box -->
                <div class="search-button">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                </div>
                <div class="topmenu-outer">
                    <div class="top-menu">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                            </li>
                            <li class="dropdown">

                                <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                                    <li class="li-group">
                                        <ul class="list-unstyled">
                                            <li class="no-link" role="presentation">
                                                Fixed Header
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right fixed-header-check" checked>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="li-group">
                                        <ul class="list-unstyled">
                                            <li class="no-link" role="presentation">
                                                Fixed Sidebar
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right fixed-sidebar-check">
                                                </div>
                                            </li>
                                            <li class="no-link" role="presentation">
                                                Horizontal bar
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right horizontal-bar-check">
                                                </div>
                                            </li>
                                            <li class="no-link" role="presentation">
                                                Toggle Sidebar
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right toggle-sidebar-check">
                                                </div>
                                            </li>
                                            <li class="no-link" role="presentation">
                                                Compact Menu
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right compact-menu-check">
                                                </div>
                                            </li>
                                            <li class="no-link" role="presentation">
                                                Hover Menu
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right hover-menu-check">
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="li-group">
                                        <ul class="list-unstyled">
                                            <li class="no-link" role="presentation">
                                                Boxed Layout
                                                <div class="ios-switch pull-right switch-md">
                                                    <input type="checkbox" class="js-switch pull-right boxed-layout-check">
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="li-group">
                                        <ul class="list-unstyled">
                                            <li class="no-link" role="presentation">
                                                Choose Theme Color
                                                <div class="color-switcher">
                                                    <a class="colorbox color-blue" href="?theme=blue" title="Blue Theme" data-css="blue"></a>
                                                    <a class="colorbox color-green" href="?theme=green" title="Green Theme" data-css="green"></a>
                                                    <a class="colorbox color-red" href="?theme=red" title="Red Theme" data-css="red"></a>
                                                    <a class="colorbox color-white" href="?theme=white" title="White Theme" data-css="white"></a>
                                                    <a class="colorbox color-purple" href="?theme=purple" title="purple Theme" data-css="purple"></a>
                                                    <a class="colorbox color-dark" href="?theme=dark" title="Dark Theme" data-css="dark"></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="no-link"><button class="btn btn-default reset-options">Reset Options</button></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"></a>
                            </li>
                            <li class="dropdown">
                                <!--<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right">4</span></a>-->
                                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                    <li>
                                        <p class="drop-title">You have 4 new messages !</p>
                                    </li>
                                    <li class="dropdown-menu-list slimscroll messages">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="#">
                                                    <div class="msg-img">
                                                        <div class="online on"></div><img class="img-circle" src="{{asset('plugin/images/avatar2.png')}}" alt="">
                                                    </div>
                                                    <p class="msg-name">Sandra Smith</p>
                                                    <p class="msg-text">Hey ! I'm working on your project</p>
                                                    <p class="msg-time">3 minutes ago</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="msg-img">
                                                        <div class="online off"></div><img class="img-circle" src="{{asset('plugin/images/avatar4.png')}}" alt="">
                                                    </div>
                                                    <p class="msg-name">Amily Lee</p>
                                                    <p class="msg-text">Hi David !</p>
                                                    <p class="msg-time">8 minutes ago</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="msg-img">
                                                        <div class="online off"></div><img class="img-circle" src="{{asset('plugin/images/avatar3.png')}}" alt="">
                                                    </div>
                                                    <p class="msg-name">Christopher Palmer</p>
                                                    <p class="msg-text">See you soon !</p>
                                                    <p class="msg-time">56 minutes ago</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="msg-img">
                                                        <div class="online on"></div><img class="img-circle" src="{{asset('plugin/images/avatar5.png')}}" alt="">
                                                    </div>
                                                    <p class="msg-name">Nick Doe</p>
                                                    <p class="msg-text">Nice to meet you</p>
                                                    <p class="msg-time">2 hours ago</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="msg-img">
                                                        <div class="online on"></div><img class="img-circle" src="{{asset('plugin/images/avatar2.png')}}" alt="">
                                                    </div>
                                                    <p class="msg-name">Sandra Smith</p>
                                                    <p class="msg-text">Hey ! I'm working on your project</p>
                                                    <p class="msg-time">5 hours ago</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="msg-img">
                                                        <div class="online off"></div><img class="img-circle" src="{{asset('plugin/images/avatar4.png')}}" alt="">
                                                    </div>
                                                    <p class="msg-name">Amily Lee</p>
                                                    <p class="msg-text">Hi David !</p>
                                                    <p class="msg-time">9 hours ago</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <!--<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right">3</span></a>-->
                                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                    <li>
                                        <p class="drop-title">You have 3 pending tasks !</p>
                                    </li>
                                    <li class="dropdown-menu-list slimscroll tasks">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="#">
                                                    <div class="task-icon badge badge-success"><i class="icon-user"></i></div>
                                                    <span class="badge badge-roundless badge-default pull-right">1min ago</span>
                                                    <p class="task-details">New user registered.</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="task-icon badge badge-danger"><i class="icon-energy"></i></div>
                                                    <span class="badge badge-roundless badge-default pull-right">24min ago</span>
                                                    <p class="task-details">Database error.</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="task-icon badge badge-info"><i class="icon-heart"></i></div>
                                                    <span class="badge badge-roundless badge-default pull-right">1h ago</span>
                                                    <p class="task-details">Reached 24k likes</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="drop-all"><a href="#" class="text-center">All Tasks</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                    <span class="user-name">{{$logado->USU_LOGIN}}<i class="fa fa-angle-down"></i></span>
                                    <img class="img-circle avatar" src="@if (isset($logado->FOTO)) {{asset('/storage/'.$logado->FOTO)}}  @else {{asset('/imagens/user_default.png')}} @endif" width="40" height="40" alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li role="presentation"><a href="{{url('adm/ver/user',$logado->ID_USUARIO)}}"><i class="fa fa-user"></i>Editar Perfil</a></li>
                                    <li role="presentation"><a href="{{url('painel/agenda-demanda')}}" target="_blank"><i class="fa fa-calendar"></i>Agenda</a></li>
                                    @if($logado->USU_NIVEL == 'A')
                                    <li role="presentation"><a href="{{url('adm/users')}}"><i class="fa fa-users"></i> Usuários<span class="badge badge-success pull-right">{{$qtdeUsers}}</span></a></li>
                                    @endif
                                    <li role="presentation" class="divider"></li>
                                    <!--
                                    <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                                    -->
                                    <li role="presentation"><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out m-r-xs"></i>Sair</a></li>
                                </ul>
                            </li>
                        </ul><!-- Nav -->
                    </div><!-- Top Menu -->
                </div>
            </div>
        </div><!-- Navbar -->
        <div class="page-sidebar sidebar">
            <div class="page-sidebar-inner slimscroll">
                <div class="sidebar-header">
                    <div class="sidebar-profile">
                        <a href="javascript:void(0);" id="profile-menu-link">
                            <div class="sidebar-profile-image">
                                <img src="@if(isset($logado->FOTO)) {{asset('/storage/'.$logado->FOTO)}}  @else {{asset('/imagens/user_default.png')}} @endif" class="img-circle img-responsive" alt="">
                            </div>
                            <div class="sidebar-profile-details">
                                <span>{{$logado->USU_LOGIN}}<br><small>@if($logado->USU_NIVEL == 'A') Administrador @elseif($logado->USU_NIVEL == "C") Comum @elseif($logado->USU_NIVEL == "S") Supervisor @endif</small></span>
                            </div>
                        </a>
                    </div>
                </div>
                <ul class="menu accordion-menu">
                    <!--
                        <li class="active"><a href="{{url('adm/home')}}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span>
                            <p>Dashboard</p>
                        </a></li>
                    -->
                    
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span>
                            <p>Cadastro</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if($logado->USU_NIVEL == 'A')
                            <li><a href="{{route('adm.users')}}">Usuários</a></li>
                            <li><a href="#">Equipamento</a></li>
                            <li><a href="{{url('admin/lista-clientes')}}">Cliente</a></li>
                            <li><a href="{{url('admin/departamentos')}}">Departamentos</a></li>
                            <li><a href="{{url('admin/lista-demandas/')}}">Demandas</a></li>
                            <li><a href="#">Orçamento</a></li>
                            <li><a href="{{url('painel/agenda')}}"></i>Agenda</a></li>
                            @endif
                            <li><a href="{{url('painel/lista-chamados')}}">Oderm de serviço</a></li>
                            
                        </ul>
                    </li>
                    
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span>
                            <p>Relatórios</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if($logado->USU_NIVEL == 'A')
                                <li><a href="{{url('painel/demandas-setores/')}}">O.S Por Setor</a></li>
                            @endif
                            @if(($logado->USU_NIVEL == 'A') || ($logado->USU_NIVEL == 'S'))
                                <li><a href="{{url('admin/list-chamados-empresa/')}}">O.S Empresa</a></li>
                            @endif
                            <li><a href="{{url('painel/agenda-demanda/')}}" target="_blank" >O.S Agendadas</a></li>
                        </ul>
                    </li>
                   
                    {{--
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th"></span>
                            <p>Configuração do Diploma</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="layout-blank.html">Fluxo de Assinaturas</a></li>
                            <li><a href="layout-boxed.html">Teste</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list"></span>
                            <p>Tables</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="table-static.html">Static Tables</a></li>
                            <li><a href="table-responsive.html">Responsive Tables</a></li>
                            <li><a href="table-data.html">Data Tables</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-edit"></span>
                            <p>Forms</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="form-elements.html">Form Elements</a></li>
                            <li><a href="form-wizard.html">Form Wizard</a></li>
                            <li><a href="form-upload.html">File Upload</a></li>
                            <li><a href="form-image-crop.html">Image Crop</a></li>
                            <li><a href="form-image-zoom.html">Image Zoom</a></li>
                            <li><a href="form-select2.html">Select2</a></li>
                            <li><a href="form-x-editable.html">X-editable</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span>
                            <p>Charts</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="charts-sparkline.html">Sparkline</a></li>
                            <li><a href="charts-rickshaw.html">Rickshaw</a></li>
                            <li><a href="charts-morris.html">Morris</a></li>
                            <li><a href="charts-flotchart.html">Flotchart</a></li>
                            <li><a href="charts-chartjs.html">Chart.js</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-log-in"></span>
                            <p>Login</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="login.html">Login Form</a></li>
                            <li><a href="login-alt.html">Login Alt</a></li>
                            <li><a href="register.html">Register Form</a></li>
                            <li><a href="register-alt.html">Register Alt</a></li>
                            <li><a href="forgot.html">Forgot Password</a></li>
                            <li><a href="lock-screen.html">Lock Screen</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-map-marker"></span>
                            <p>Maps</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="maps-google.html">Google Maps</a></li>
                            <li><a href="maps-vector.html">Vector Maps</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-gift"></span>
                            <p>Extra</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="404.html">404 Page</a></li>
                            <li><a href="500.html">500 Page</a></li>
                            <li><a href="invoice.html">Invoice</a></li>
                            <li><a href="calendar.html">Calendar</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="todo.html">Todo</a></li>
                            <li><a href="pricing-tables.html">Pricing Tables</a></li>
                            <li><a href="shop.html">Shop</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="timeline.html">Timeline</a></li>
                            <li><a href="search.html">Search Results</a></li>
                            <li><a href="coming-soon.html">Coming Soon</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </li>
                    <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-flash"></span>
                            <p>Levels</p><span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="droplink"><a href="#">
                                    <p>Level 1.1</p><span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="droplink"><a href="#">
                                            <p>Level 2.1</p><span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Level 3.1</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Level 2.2</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Level 1.2</a></li>
                        </ul>
                    </li>
                    --}}
                </ul>
            </div><!-- Page Sidebar Inner -->
        </div><!-- Page Sidebar -->
        <div class="page-inner">

             <!-- Javascripts -->

            <script src="{{asset('plugin/plugins/jquery/jquery-2.1.4.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="{{asset('plugin/plugins/pace-master/pace.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
            <script src="{{asset('plugin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/switchery/switchery.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/uniform/jquery.uniform.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/offcanvasmenueffects/js/classie.js')}}"></script>
            <script src="{{asset('plugin/plugins/offcanvasmenueffects/js/main.js')}}"></script>
            <script src="{{asset('plugin/plugins/waves/waves.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/3d-bold-navigation/js/main.js')}}"></script>
            <script src="{{asset('plugin/plugins/jquery-mockjax-master/jquery.mockjax.js')}}"></script>
            <script src="{{asset('plugin/plugins/moment/moment.js')}}"></script>
            <script src="{{asset('plugin/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js')}}"></script>
            <script src="{{asset('plugin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
            <script src="{{asset('plugin/js/modern.min.js')}}"></script>
            <script src="{{asset('plugin/js/pages/table-data.js')}}"></script>
            <script src="{{asset('plugin/plugins/flot/jquery.flot.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/flot/jquery.flot.time.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/flot/jquery.flot.symbol.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/flot/jquery.flot.resize.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/curvedlines/curvedLines.js')}}"></script>
            <script src="{{asset('plugin/plugins/metrojs/MetroJs.min.js')}}"></script>

            <script src="{{asset('plugin/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/jquery-counterup/jquery.counterup.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/toastr/toastr.min.js')}}"></script>

            <script src="{{asset('plugin/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
            <script src="{{asset('plugin/js/pages/table-data.js')}}"></script>

            <script src="{{asset('plugin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{asset('plugin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
            <script src="{{asset('js/customizado.js')}}"></script>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <!--<script src="{{asset('plugin/js/pages/charts-chartjs.js')}}"></script>-->
            <!--<script src="{{asset('plugin/js/pages/charts-morris.js')}}"></script>-->
            <script src="{{asset('plugin/plugins/morris/raphael.min.js')}}"></script>
            <script src="{{asset('plugin/plugins/morris/morris.min.js')}}"></script>

            @yield('content')
            <div class="page-footer">
                <p class="no-s">2023 &copy; GRAU CERTO.</p>
            </div>
        </div><!-- Page Inner -->

        <!-- SEM EFEITO -->
        <!-- Javascripts -->

       
       </main>

</body>

</html>
