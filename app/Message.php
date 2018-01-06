<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\MessagePresenter;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable  = ['nombre', 'email', 'mensaje'];

       
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function note()
    {
        //Se puede usar morphOne o morphMany
        return $this->morphOne(Note::class,'notable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
   
    public function present()
    {
        return new MessagePresenter($this);
    }
    
}
