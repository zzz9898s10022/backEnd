@extends('layouts/app')

@section('content')
<div class="container">
    <h1>編輯消息</h1>
    <form method="POST" action="/home/products/update/{{$products->id}}">
        @csrf
        <div class="form-group">
            <label for="img">IMG：</label>
            <input type="text" class="form-control" id="img" name="img" value="{{$products->img}}">
        </div>
        <div class="form-group">
            <label for="sort">Sort：</label>
            <input type="text" class="form-control" id="sort" name="sort">
        </div>
        <div class="form-group">
            <label for="title">Title：</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$products->title}}">
        </div>
        <div class="form-group">
            <label for="content">請輸入說明內文：</label>
            <textarea class="form-control" id="content" name="content" cols="30" rows="10">{{$products->content}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">送出</button>

    </form>
</div>
@endsection
