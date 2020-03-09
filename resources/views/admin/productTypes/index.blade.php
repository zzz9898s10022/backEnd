@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <a href="/home/productTypes/create" class="btn btn-success">新增產品類型</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>type</th>
                <th>sort</th>
                <th width="100"></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $items as $item)
            <tr>
                <td>{{$item->type}}</td>
                <td>{{$item->sort}}</td>
                {{-- {!! !!}可以讓程式碼自動轉換成css --}}
                <td>
                    <a href="/home/productTypes/edit/{{$item->id}}" class="btn btn-success">修改</a>
                    <button class="btn btn-danger" onclick="show_confirm({{$item->id}})">刪除</button>

                    <form id="delete-form-{{$item->id}}" action="/home/productTypes/delete/{{$item->id}}" method="POST"
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
        "order": [[1,'desc']]
        });
    } );

        function show_confirm(id)
        {
            var r=confirm("確定刪除?");
            if (r==true)
            {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }

</script>
@endsection
