<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
      'product_id','quantity','ip_address',
    ];

    public function product(){
      return $this->belongsTo('App\Product')->withTrashed();
    }
}
