<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Testimonial extends Model
{
    use softDeletes;
    protected $fillable = [
      'client_name','client_working_position','client_picture','client_description'
    ];
}
