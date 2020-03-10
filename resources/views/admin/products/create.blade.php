@extends('layouts/app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <form method="POST" action="/home/products/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">主要圖片上傳：</label>
            <input type="file" class="form-control" id="img" name="img" required>
        </div>
        <div class="form-group">
            <label for="img">多張圖片上傳：</label>
            <input type="file" class="form-control" id="img" name="products_imgs[]" required multiple>
            {{--1.多張圖片的name後面要加[]因為是要從陣列中取出單筆資料
                2.因為是複數，要再增加一個multiple的屬性 --}}
        </div>
        <div class="form-group">
            <label for="title">Title：</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">輸入內文：</label>
            <textarea type="text" class="form-control" id="content" name="content" required></textarea>

        </div>
        <button type="submit" class="btn btn-primary">送出</button>
    </form>
</div>
@endsection

@section('js')


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>


<script>
    $(document).ready(function() {
        $('#content').summernote({
            minHeight:100,
        });
    });
</script>
@endsection
