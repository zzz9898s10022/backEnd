<?php

namespace App\Http\Controllers;

use App\News;

use App\Products;
use App\Contact_us;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $product_data = Products::orderBy('sort', 'desc')->get();
        return view('front/products');
    }
    public function contact_us() {

        return view('front/contact_us');
    }
    public function contact_us_store(Request $request) {
        $user_data =$request->all();

        $content=Contact_us::create($user_data);
        // Mail::to($user_data->email)->send(new OrderShipped($content)); //寄信user
        Mail::to('zzz9898s10022@gmail.com')->send(new OrderShipped($content));//寄信admin
        // Mail::to($request->user())->send(new OrderShipped($content));
        // 寄信
        return redirect('/contact_us');
        // return redirect跟return view不同，不需要再次從front開始傳回
    }



    public function product_detail(){
        return view('front/product_detail');
    }
}
