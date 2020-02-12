<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use View;

class receipt extends Model
{
    use SoftDeletes;
    protected $table ='receipts';
    protected $dates = ['deleted_at'];
    protected $fillable =['receipts'];
}
