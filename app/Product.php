<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
    use softDeletes;
    protected $fillable = [
      'product_name','category_id','product_price','product_thumbnail_picture','product_quantity','product_short_description','product_long_description'
    ];

    function relationToCategory(){
      return $this->hasOne('App\Category','id','category_id');
    }

    public function cart(){
      return $this->hasOne('App\Cart');
    }
}
