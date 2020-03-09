<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTypes;

class ProductTypesController extends Controller
{
    public function index()
    {
        $items = ProductTypes::all();

        return view('admin/productTypes/index', compact('items'));
    }

    public function create()
    {
        return view('admin/productTypes/create');
    }

    public function store(Request $request)
    {
        $items = $request->all();


        $items = ProductTypes::create($items);
        //create 多張圖片


        return redirect('/home/productTypes');
        //重新導向/home/news
    }

    public function edit($id)
    {
        // $news = News::find($id);
        $news = ProductTypes::with("news_imgs")->find($id);
        return view('admin/productTypes/edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request_data = $request->all();

        $item = ProductTypes::find($id);

        return redirect('/home/productTypes');
    }

    public function delete(Request $request, $id)
    {
        // News::find($id)->delete();
        $item = ProductTypes::find($id);

        $item->delete();
       //把該筆資料刪除

        return redirect('/home/productTypes');
    }
}
