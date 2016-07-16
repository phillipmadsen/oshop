<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";
    protected $fillable = ['name','email','user_id','message','subject','opened'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
