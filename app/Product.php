<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ['name' , 'manufacturer' , 'price' , 'details' , 'quantity' , 'category_id' , 'thumbnail'];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_product');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Cart');
    }

    public function photos()
    {
        return $this->hasMany('App\AlbumPhoto');
    }

    public function options(){
        return $this->hasMany('App\Option');
    }
}
