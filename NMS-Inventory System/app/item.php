<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class item extends Model
{
    use SoftDeletes;
    protected $fillable =['items'];
    protected $table ='items';
    protected $dates = ['deleted_at'];

}
