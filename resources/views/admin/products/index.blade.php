@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <a href="/home/products/create" class="btn btn-success">新增產品種類</a>
    <hr>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>img</th>
                <th>sort</th>
                <th>title</th>
                <th>content</th>
                <th width="140"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($all_products as $item)
            <tr>
                <td><img width="120" src="{{$item->img}}" alt=""></td>
                <td>{{$item->sort}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->content}}</td>
                <td>
                    <a href="/home/products/edit/{{$item->id}}" class="btn btn-success">修改</a>
                    <button class="btn btn-danger" onclick="show_confirm({{$item->id}})">刪除</button>

                    <form id="delete-form-{{$item->id}}" action="/home/products/delete/{{$item->id}}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>

</div>

@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
        "order": [1]
        });
    } );

        function show_confirm(id)
        {
            var r=confirm("Press a button!");
            if (r==true)
            {
                document.getElementById('delete-form-'+id).submit();
            }
        }

</script>
@endsection
