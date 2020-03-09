<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class Persona extends Model
{
    use SoftDeletes;
    protected $fillable =['personas'];
    protected $table ='personas';
    protected $dates = ['deleted_at'];

}
