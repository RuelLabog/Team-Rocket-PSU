<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class Operator extends Model
{
    use SoftDeletes;
    // protected $fillable =['users'];
    protected $table ='users';
    protected $dates = ['deleted_at'];

}
