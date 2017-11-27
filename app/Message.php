<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];
    //todos los campos se pueden asignar masivamente, menos el id

    public function sender(){

        return $this->belongsTo(User::class, 'sender_id');

    }
    
}
