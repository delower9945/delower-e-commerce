<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Contact extends Model
{
  use softDeletes;
  protected $fillable = [
    'name','email','subject','message','status',
  ];
}
