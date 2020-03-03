@extends('layouts/app')

@section('content')
<div class="container">
    <form method="POST" action="/home/news/store">
        @csrf
        <div class="form-group">
            <label for="img">影像圖路徑：</label>
            <input type="text" class="form-control" id="img" name="img">
        </div>

        <div class="form-group">
            <label for="title">請輸入抬頭：</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="content">請輸入說明內文：</label>
            <input type="text" class="form-control" id="content" name="content">
        </div>

        <button type="submit" class="btn btn-primary">送出</button>
        
    </form>
</div>
@endsection
