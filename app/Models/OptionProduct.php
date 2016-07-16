<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionProduct extends Model
{
    protected $table = "products";
    protected $fillable = ['product_id','option_id'];

}
