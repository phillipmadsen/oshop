<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = "userinfo";

    protected $fillable = ['user_id' , 'photo' , 'firstname' , 'lastname' , 'address' , 'address' , 'country' , 'city' , 'zipcode' , 'phone'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
