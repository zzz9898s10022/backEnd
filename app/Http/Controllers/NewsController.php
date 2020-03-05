<?php

namespace App\Http\Controllers;

use App\News;
use App\News_imgs;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $all_news = News::all();

        return view('admin/news/index', compact('all_news'));
    }

    public function create()
    {
        return view('admin/news/create');
    }

    public function store(Request $request)
    {
        $news_data = $request->all();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $news_data['img'] = $path;
        }
        $new_news = News::create($news_data);
        // News::create($news_data);
        // $file_name = $request->file('img')->store('', 'public');
        // $requestData['img'] = $file_name;
        //create 多張圖片
        if($request->hasFile('news_imgs'))
        {
            $files = $request->file('news_imgs');
            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'news');

                //建立News多張圖片的資料
                $news_imgs = new News_imgs;
                $news_imgs->news_id = $new_news->id;
                $news_imgs->img = $path;
                $news_imgs->save();
            }
        }


        return redirect('/home/news');
        //重新導向/home/news
    }


    public function edit($id)
    {
        // $news = News::find($id);
        $news = News::with("news_imgs")->find($id);
        return view('admin/news/edit', compact('news'));
    }
    public function update(Request $request, $id)
    {
        // News::find($id)->update($request->all());
        $request_data = $request->all();

        $item = News::find($id);

        //if有上傳新圖片
        if ($request->hasFile('img')) {
            //舊圖片刪除
            $old_image = $item->img;
            File::delete(public_path() . $old_image);

            //上傳新圖片
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $request_data['img'] = $path;
        }

        $item->update($request_data);
        return redirect('/home/news');
    }


    public function delete(Request $request, $id)
    {
        // News::find($id)->delete();
        $item = News::find($id);

        $old_image = $item->img;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }

        $item->delete();

        return redirect('/home/news');
    }
    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
}
