<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class item extends Model
{
    use SoftDeletes;
    protected $table ='items';
    protected $dates = ['deleted_at'];
    protected $fillable =['items'];
}
