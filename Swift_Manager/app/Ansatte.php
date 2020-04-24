<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ansatte extends Model
{
    protected $table = 'ansatte';
    protected $fillable = ['name','email','username'];
}
