@extends('layout')

@section('contenido')

    <h1>Editar Mensaje</h1>
     <form method="POST" action="{{route('mensajes.update', $message->id)}}"> 
        {!! method_field('PUT')!!}
        @include('messages.form', [
             'btnText' => 'Actualizar',
             'showFields' => ! $message->user_id
             ])
    </form>
    <hr>
@stop   