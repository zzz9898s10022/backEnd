<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductsImgs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function index()
    {
        $all_products = Products::all();

        return view('admin/products/index', compact('all_products'));
    }

    public function create()
    {
        return view('admin/products/create');
    }

    public function store(Request $request)
    {
        $products_data = $request->all();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'products');
            $products_data['img'] = $path;
        }
        $new_products =Products::create($products_data);
        //create 多張圖片
        if ($request->hasFile('products_imgs')) {
            $files = $request->file('products_imgs');
            foreach ($files as $file) {
                //上傳圖片

                $path = $this->fileUpload($file, 'products');


                $products_imgs = new ProductsImgs;
                //建立products多張圖片的資料
                $products_imgs->products_id = $new_products->id;
                //翻譯：$products_imgs裡面的products_id欄位，會指向父層products的id
                $products_imgs->img_url = $path;
                //翻譯：$products_imgs裡面的img_url欄位，會指向多張圖片儲存的路徑
                $products_imgs->save();
            }
        // Products::create($products_data)->save();
        }
        return redirect('/home/products');
    }


    public function edit($id)
    {
        // $products = Products::find($id);
        $products = Products::with("products_imgs")->find($id);
        return view('admin/products/edit', compact('products'));
    }
    public function update(Request $request, $id)
    {
        Products::find($id)->update($request->all());
        return redirect('/home/products');
    }


    public function delete(Request $request,$id)
    {
        // Products::find($id)->delete();
        // return redirect('/home/products');
        $item = Products::find($id);

        $old_image = $item->img;
        //舊的單張圖片=給他一個old_image的名字
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        //如果檔案裏面有這張圖,則刪除此張圖
        $item->delete();
       //把該筆資料刪除


        //多圖片刪除
        $products_imgs = ProductsImgs::where('products_id', $id)->get();
        //去找到productsImg裡面products_id=選到的那個新聞
        foreach ($products_imgs as $products_img) {

            $old_image = $products_img->img_url;
            //此$old_image為一變數，跟上面的不一樣
            if (file_exists(public_path() . $old_image)) {
                File::delete(public_path() . $old_image);
            }

            $products_img->delete();
        }

        return redirect('/home/products');
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
        $productsimgid = $request->productsimgid;
        $item = ProductsImgs::find($productsimgid);
        $old_image = $item->img_url;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $item->delete();

        return "";
    }
    public function ajax_post_sort(Request $request)
    {
        $products_img_id = $request->id;
        $sort = $request->sort;
        $img = ProductsImgs::find($products_img_id);
        $img->sort = $sort;
        $img->save();

        return "";
    }
}
