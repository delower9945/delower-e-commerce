<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Blog extends Model
{
    use softDeletes;
    protected $fillable = [
      'post_title','user_id','post_picture','post_description',
    ];

    public function relationToUser(){
      return $this->hasOne('App\User','id','user_id');
    }


}
