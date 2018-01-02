<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Conmutador que sirve para definir un valor antes de guardarlo en DB
    //Sirve para guardar siempre el password encriptado
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }


    public function hasRoles(array $roles)
    {
        // (bool) sire para cambiar el resultado del metodo count a booleano
        // pluck() regresa un array con la llave que se pasa por parametro 
        // contains() verifica si la coleccion contiene el dato que se le pasa por parametro return true o false
        // intersect()  verifica si existen coincidencia entre el array con el que se le pasa por parametro
        
        return (bool) $this->roles->pluck('name')->intersect($roles)->count();
        /*
        foreach($roles as $role)
        {
            return $this->roles->pluck('name')->contains($role);
              foreach($this->roles as $userRole)
            {
                if( $userRole->name === $role)
                {
                    return true;
                }
            }  
        }
        */

        
    }
    public function isAdmin()
    {
        return $this->hasRoles(['admin']);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function note()
    {
        //Se puede usar morphOne o morphMany
        return $this->morphOne(Note::class,'notable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimeStamps();
    }
}
