<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "pages";
    protected $fillable = ['page_title','page_name','page_source'];
}
