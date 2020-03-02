<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    // 單筆資料可不用[]
    protected $fillable = [
        'img', 'title', 'content',
    ];
    // 陣列的項目名稱必須跟資料庫裏面的名稱一樣
}
