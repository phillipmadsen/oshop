<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class AlbumPhoto extends Model
{
    protected $table = 'product_album';
    protected $guarded = ['id'];
    
    public function product()
    {
        return $this->belongsToMany('App\Product');
    }
}
