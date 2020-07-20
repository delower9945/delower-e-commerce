<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Cupon extends Model
{
    use softDeletes;

    protected $fillable = [
      'cupon_name','discount_amount','validity_till',
    ];
}
