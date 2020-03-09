@extends('layouts/app')


@section('content')
<div class="container">
    <h1>編輯消息</h1>

    <form method="POST" action="/home/productTypes/update/{{$items->id}}">
        @csrf

        <div class="form-group">
            <label for="type">type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{$items->type}}">
        </div>

        <div class="form-group">
            <label for="sort">權重(數字越大排越前面)</label>
            <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$items->sort}}">
        </div>

        <button type="submit" class="btn btn-primary">送出</button>
    </form>
</div>
@endsection


