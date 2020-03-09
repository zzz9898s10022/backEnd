<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $table = 'ProductTypes';
    // 單筆資料可不用[]
    protected $fillable = [
        'type', 'sort',
    ];
   
}
