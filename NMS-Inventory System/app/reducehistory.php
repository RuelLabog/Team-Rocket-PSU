<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class reducehistory extends Model
{
    use SoftDeletes;
    protected $fillable =['dechistory'];
    protected $table ='dechistory';
    protected $dates = ['datedec'];

}
