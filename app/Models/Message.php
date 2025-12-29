<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name','email','phone','subject','message','read_at'];

    protected $dates = ['read_at'];
}
