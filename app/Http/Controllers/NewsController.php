<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsImgs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        // News::create($news_data);
        // $file_name = $request->file('img')->store('', 'public');
        // $requestData['img'] = $file_name;


        $new_news = News::create($news_data);
        //create 多張圖片
        if ($request->hasFile('news_imgs')) {
            $files = $request->file('news_imgs');
            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file, 'news');


                $news_imgs = new NewsImgs;
                //建立News多張圖片的資料
                $news_imgs->news_id = $new_news->id;
                //翻譯：$news_imgs裡面的news_id欄位，會指向父層News的id
                $news_imgs->img_url = $path;
                //翻譯：$news_imgs裡面的img_url欄位，會指向多張圖片儲存的路徑
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

        if ($request->hasFile('news_imgs')) {
            $files = $request->file('news_imgs');
            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file, 'news');

                //建立News多張圖片的資料
                $news_imgs = new NewsImgs;
                $news_imgs->news_id = $item->id;
                //翻譯：$news_imgs裡面的news_id欄位，會指向父層item的id
                $news_imgs->img_url = $path;
                //翻譯：$news_imgs裡面的img_url欄位，會指向多張圖片儲存的路徑
                $news_imgs->save();
            }
        }
        $item->update($request_data);
        return redirect('/home/news');
    }

    public function delete(Request $request, $id)
    {
        // News::find($id)->delete();
        $item = News::find($id);

        $old_image = $item->img;
        //舊的單張圖片=給他一個old_image的名字
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        //如果檔案裏面有這張圖,則刪除此張圖
        $item->delete();
       //把該筆資料刪除


        //多圖片刪除
        $news_imgs = NewsImgs::where('news_id', $id)->get();
        //去找到NewsImg裡面news_id=選到的那個新聞
        foreach ($news_imgs as $news_img) {

            $old_image = $news_img->img_url;
            //此$old_image為一變數，跟上面的不一樣
            if (file_exists(public_path() . $old_image)) {
                File::delete(public_path() . $old_image);
            }

            $news_img->delete();
        }

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


    public function ajax_delete_news_imgs(Request $request)
    {
        $newsimgid = $request->newsimgid;
        $item = NewsImgs::find($newsimgid);
        $old_image = $item->img_url;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $item->delete();

        return "";
    }
    public function ajax_post_sort(Request $request)
    {
        $news_img_id = $request->id;
        $sort = $request->sort;
        $img = NewsImgs::find($news_img_id);
        $img->sort = $sort;
        $img->save();

        return "";
    }
}
