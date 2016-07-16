<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $table = "option_values";
    protected $guarded = ['id'];

    public function option()
    {
        return $this->belongsTo('App\Option');
    }

}
