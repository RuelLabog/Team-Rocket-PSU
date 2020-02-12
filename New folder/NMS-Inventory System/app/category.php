<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable =['categories'];
    protected $table = 'categories';
}
