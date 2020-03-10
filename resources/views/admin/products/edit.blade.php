@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .products_img_card .btn-danger {
        position: absolute;
        right: -5px;
        top: -15px;
        border-radius: 50%;
    }
</style>
@endsection


@section('content')

<div class="container">
    <h1>編輯消息</h1>

    <form method="POST" action="/home/products/update/{{$products->id}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">主要圖片</label>
            <img class="img-fluid" width="250" src="{{$products->img}}" alt="">
        </div>
        <div class="form-group">
            <label for="title">重新上傳圖片(建議圖片尺寸寬400px x 高200px)：</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <div class="row">
            現有多張圖片
            @foreach ($products->products_imgs as $item)
            <div class="col-2">
                <div class="products_img_card" data-productsimgid="{{$item->id}}">
                    <button type="button" class="btn btn-danger" data-productsimgid="{{$item->id}}">X</button>
                    <img class="img-fluid" src="{{$item->img_url}}" alt="">
                    <input class="form-control" type="text" value="{{$item->sort}}" onchange="ajax_post_sort(this,{{$item->id}})">
                </div>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="title">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
            <input type="file" class="form-control" id="products_imgs" name="products_imgs[]" multiple>
            {{-- 如果增加require屬性，則每次修改時一定要添加東西才行 --}}
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$products->title}}">
        </div>

        <div class="form-group">
            <label for="sort">權重(數字越大排越前面)</label>
            <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$products->sort}}">
        </div>

        <div class="form-group">
            <label for="content">請輸入說明內文：</label>
            <textarea class="form-control" id="content" name="content" cols="30" rows="10">{!!$products->content!!}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">送出</button>
    </form>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.products_img_card .btn-danger').click(function(){
        var productsimgid = this.getAttribute('data-productsimgid')

        $.ajax({
            url: "/home/ajax_delete_products_imgs",
            method: 'post',
            data: {
            productsimgid: productsimgid,
            },
            success: function(result){
                $(`.products_img_card[data-productsimgid=${productsimgid}]`).remove();
            }
        });
    });
    function ajax_post_sort(element,img_id){
        var img_id = img_id;
        var sort_value = element.value;
        // console.log(img_id);
        // console.log(sort_value);
        $.ajax({
            url: "/home/ajax_post_sort",
            method: 'post',
            data: {
                id: img_id,
                sort: sort_value
            },
            success: function(result){
                console.log(result);

            }
        });
    }
    $(document).ready(function() {
        $('#content').summernote({
            minHeight:100,
        });
    });
    // $('#content' *)
</script>
@endsection
