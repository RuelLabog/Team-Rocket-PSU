<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class Service extends Model
{
    use SoftDeletes;
    protected $fillable =['services'];
    protected $table ='services';
    protected $dates = ['deleted_at'];

}
