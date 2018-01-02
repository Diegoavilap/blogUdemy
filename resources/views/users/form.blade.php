{!!csrf_field()!!}
<div class="form-group">
    <label for="nombre">
        Nombre
        <input class="form-control" type="text" name="name" value="{{$user->name or old('nombre')}}">
        {!! $errors->first('name','<span class=error>:message</span>')!!}
    </label>
</div>
<div class="form-group">
    <label for="email">
        Email
        <input class="form-control" type="email" name="email" value="{{$user->email or old('email')}}">
        {!! $errors->first('email','<span class=error>:message</span>')!!}
    </label>
</div>
@unless($user->id)
    <div class="form-group">
        <label for="password">
            Password
            <input class="form-control" type="password" name="password" >
            {!! $errors->first('password','<span class=error>:message</span>')!!}
        </label>
    </div>
    <div class="form-group">
        <label for="password_confirmation">
            Password Confirm
            <input class="form-control" type="password" name="password_confirmation" >
            {!! $errors->first('password_confirmation','<span class=error>:message</span>')!!}
        </label>
    </div>
@endunless
<div class="checkbox">
    @foreach ($roles as $id => $name)
        <label >
            <input 
                type="checkbox" 
                name="roles[]" 
                {{ $user->roles->pluck('id')->contains($id) ? 'checked' : ''}}
                value="{{$id}}">
            {{$name}}
        </label>
    @endforeach
        
</div>
{!! $errors->first('roles','<span class=error>:message</span>')!!}
<hr>
