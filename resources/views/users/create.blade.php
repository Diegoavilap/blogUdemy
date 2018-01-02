@extends('layout')

@section('contenido')
    <h1>Crear Usuario</h1>
    @if(session()->has('info'))
        <div class="alert alert-success">{{session('info')}}</div>
    @endif
     <form method="POST" action="{{route('usuarios.store')}}"> 
        
        @include('users.form', ['user' => new App\User])
        <input class="btn btn-primary" type="submit" value="Guardar">

    </form>
    <hr>
@stop