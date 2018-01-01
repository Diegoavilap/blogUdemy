{!!csrf_field()!!}
{{--  @unless significa que "A menos de que tenga la condición"  --}}
@unless( isset($message) and $message->user_id)
    <div class="form-group">
        <label for="nombre">
            Nombre
            <input class="form-control" type="text" name="nombre" 
                value="{{ $message->nombre or old('nombre')}}">
            {!! $errors->first('nombre','<span class=error>:message</span>')!!}
        </label>
    </div>
    <div class="form-group">
        <label for="email">
            Email
            <input class="form-control" type="email" name="email"
                 value="{{ $message->email or old('email')}}">
            {!! $errors->first('email','<span class=error>:message</span>')!!}
        </label>
    </div>
@endunless
<div class="form-group">
    <label for"mensaje"> 
        Mensaje
        <textarea class="form-control" name="mensaje" >{{$message->mensaje or old('mensaje')}}</textarea>
        {!! $errors->first('mensaje','<span class=error>:message</span>')!!}
    </label>
</div>
{{-- {{ isset($btnText) ? $btnText : 'Guardar' }} se puede reemplazar por or --}}
<input class="btn btn-primary" type="submit" value="{{ $btnText or 'Guardar' }}">