<?php

namespace App\Http\Controllers;

use App\News;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front/index');
    }

    // public function news()
    // {
    //     $news_data = News::table('news')->orderBy('sort', 'desc')->get();
    //     //orderBy的意思為按照sort大到小排列順序
    //     return view('front/news', compact('news_data'));
    // }
    public function news() {
        $news_data = News::orderBy('sort', 'desc')->get();
        return view('front/news',compact('news_data'));
    }

    public function news_detail($id)
    {
        $news = News::with('news_imgs')->find($id);

        return view('front/news_detail',compact('news'));
    }
    public function products() {
        $news_data = News::orderBy('sort', 'desc')->get();
        return view('front/products');
    }
    public function contact_us() {
        $news_data = News::orderBy('sort', 'desc')->get();
        return view('front/contact_us');
    }
    public function product_detail(){
        return view('front/product_detail');
    }
}
