@extends('layouts/app')

@section('content')

<div class="container">
    <h1>新增最新消息</h1>
    <form method="POST" action="/home/news/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">主要圖片上傳：</label>
            <input type="file" class="form-control" id="img" name="img" required>
        </div>
        <div class="form-group">
            <label for="img">多張圖片上傳：</label>
            <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" required multiple>
            {{--1.多張圖片的name後面要加[]因為是要從陣列中取出單筆資料
                2.因為是複數，要再增加一個multiple的屬性 --}}
        </div>
        <div class="form-group">
            <label for="title">Title：</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">輸入內文：</label>
            <input type="text" class="form-control" id="content" name="content" required>
        </div>
        <button type="submit" class="btn btn-primary">送出</button>
    </form>
</div>

@endsection
