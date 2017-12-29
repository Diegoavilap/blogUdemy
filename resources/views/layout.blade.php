<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet" >
        
    </head>
    <body>
        <header>
            <?php function activeMenu($url){
                return request()->is($url) ? 'active': '';
            } ?>
            
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">BlogUdemy</a>
                    </div>
                
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="{{activeMenu('/')}}">
                                <a href="{{ route('home') }}">Inicio</a>
                            </li>
                            <li class="{{activeMenu('saludos/*')}}">
                                <a href="{{ route('saludos','Jorge') }}">Saludo</a>
                            </li>
                            <li class="{{activeMenu('mensajes/create')}}">
                                <a  href="{{ route('mensajes.create') }}">Contacto</a>
                            </li>
                            @if(Auth::check())    
                                <li class="{{activeMenu('mensajes*')}}">
                                    <a  href="{{ route('mensajes.index') }}">Mensajes</a>
                                </li>
                                @if (Auth::user()->hasRoles(['admin']))
                                    <li class="{{activeMenu('usuarios*')}}">
                                        <a  href="{{ route('usuarios.index') }}">Usuarios</a>
                                    </li>
                                @endif
                            @endif
                            
                        </ul>
                        
                        <ul class="nav navbar-nav navbar-right">
                            @if(Auth::guest())
                            <li class="{{activeMenu('login')}}">
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            @else
                                
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name}} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </li> 
                            @endif
                             
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
            
        </header>
        <div class="container">
            @yield('contenido')
            <footer> Copyright * {{date('Y')}}</footer>
        </div>
        <script src="/js/all.js"></script>
    </body>
</html>