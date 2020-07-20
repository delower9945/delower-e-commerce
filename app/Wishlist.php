<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
      'product_id','wishlist','ip_address',
    ];

    public function product(){
      return $this->belongsTo('App\Product')->withTrashed();
    }
}
