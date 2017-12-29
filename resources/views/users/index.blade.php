@extends('layout')
@section('contenido')
    <h1>Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user )
                <tr>
                    <td>{{ $user->id}}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email}}</td>
                    <td>
                        @foreach( $user->roles as $role)
                            {{ $role->display_name}} 
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-info btn-xs" href="{{route('usuarios.edit', $user->id) }}">
                        Editar
                        </a>
                        <form style ="display:inline" method="POST" action="{{route('usuarios.destroy', $user->id)}}">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="btn btn-danger btn-xs" type="submit">Eliminar </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
