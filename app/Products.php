<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    // 表示在資料庫中找到名稱為products的資料庫
    protected $fillable = [
        'products_types','img','title','content','sort'
    ];

    public function products_imgs()
    {
        return $this->hasMany('App\ProductsImgs')->orderby('sort','desc');
    }
    //回傳app\NewsImgs

}
