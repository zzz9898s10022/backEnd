<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'products_types','img','title','content','sort'
    ];

    public function products_imgs()
    {
        return $this->hasMany('App\ProductsImgs')->orderby('sort','desc');
    }
    //回傳app\NewsImgs

}
