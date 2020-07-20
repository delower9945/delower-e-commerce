<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
      'slider_title','slider_picture','slider_description',
    ];
}
