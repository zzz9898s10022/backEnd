<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'img','sort','title','content'
    ];

    public function products_imgs()
    {
        return $this->belongsTo('App\ProductsImgs')->orderby('sort','desc');
    }
    //回傳app\NewsImgs

}
