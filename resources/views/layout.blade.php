<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <style>
            .active{
                text-decoration: none;
                color: green;
            }
            .error{
                color:red;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <header>
            <?php function activeMenu($url){
                return request()->is($url) ? 'active': '';
            } ?>
            
            <nav>
                <a class="{{activeMenu('/')}}" href="{{ route('home') }}">Inicio</a>
                <a class="{{activeMenu('saludos/*')}}" href="{{ route('saludos','Jorge') }}">Saludo</a>
                <a class="{{activeMenu('mensajes/create')}}" href="{{ route('mensajes.create') }}">Contacto</a>
                <a class="{{activeMenu('mensajes')}}" href="{{ route('mensajes.index') }}">Mensajes</a>
                
            </nav>
        </header>
        @yield('contenido')
        <footer> Copyright * {{date('Y')}}</footer>
    </body>
</html>