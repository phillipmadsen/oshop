<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['name','section_id'];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'category_product');
    }

    public function subcats()
    {
        return $this->hasMany('App\SubCategory');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
