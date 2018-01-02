<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['body'];
    
    public function notable()
    {
        //Esto es para que acepte una relacion con varios modelos
        return $this->morphTo();
    } 
}
