@extends('layouts/app')

@section('content')
<div class="container">
    <h1>新增產品類型</h1>
    <form method="POST" action="/home/productTypes/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type">type</label>
            <input type="text" class="form-control" id="type" name="type" >
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="text" min="0" class="form-control" id="sort" name="sort" >
        </div>

        <button type="submit" class="btn btn-primary">送出</button>
    </form>
</div>
@endsection

