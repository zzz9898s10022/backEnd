@extends('layouts/nav')
@section('css')
<style>
    .product_card .color {
        padding: 10px 20px;
        width: 160px;
        min-height: 58px;
        height: 100%;
        font-size: 16px;
        line-height: 20px;
        color: #757575;
        text-align: center;
        border: 1px solid #eee;
        background-color: #fff;
        user-select: none;
        cursor: pointer;
        position: relative
    }

    .product_card .color::before {
        content: ("");
        position: absolute;
        display: inline-block;
        flex-shrink: 0;

        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .1);
    }

    .product_card .color.active {
        color: #424242;
        border-color: #ff6700;
    }
</style>
@endsection



@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7" style="padding-top:100px">
    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="product_card">
                    <div class="product_info">
                        <div>Redmi Note 8 Pro</div>
                        <div>6GB+64GB, 冰翡翠</div>
                        <div>NT$6,599</div>
                    </div>
                    <div class="product_tip">
                        icon雙倍該商品可享受雙倍積分
                    </div>
                    <div class="product_capacity">
                        容量
                        <div class="row">
                            <div class="row-cols-4">
                                <div class=></div>
                                <div class="capacity">
                                    6GB+64GB
                                </div>
                            </div>
                            <div class="row-cols-4">
                                <div class="capacity">
                                    6GB+128GB
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_color">
                        顏色
                        <div class="row">
                            <div class="row-cols-4">
                                <div class="color" data-color="冰翡翠">
                                    冰翡翠
                                </div>
                            </div>
                            <div class="row-cols-4">
                                <div class="color" data-color="珍珠白">
                                    珍珠白
                                </div>
                            </div>
                            <div class="row-cols-4">
                                <div class="color" data-color="電光灰">
                                    電光灰
                                </div>
                            </div>
                            <div class="row-cols-4">
                                <div class="color" data-color="深海藍">
                                    深海藍
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="product_qty">
                            數量
                            <a id="minus" href="#">-</a>
                            <input type="number" value="1" id="qty" min=0>
                            <a id="plus" href="#">+</a>
                        </div>
                        <div class="product_total">
                            <div>
                                <span>Redmi Note 8 Pro</span>
                                <span>冰翡翠</span>
                                <span>6GB+64GB</span>
                                *
                                <span>1</span>
                                <span>NT$6,599</span>
                            </div>
                            <div>
                                <span>總計：</span>
                                <span>NT$6,599</span>
                            </div>
                        </div>
                        {{-- <input type="text" name=""> --}}
                        <input type="text" name="capacity" id="capacity">
                        <input type="text" name="color" id="color" value="">
                        <button>立即購買</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')


<script>
    $('.product_card .color').click(function(){
        $('*').removeClass('active');
        $(this).addClass('active');
        //把顏色 放入 input的value中

        //get data attr value
        var color = $(this).attr("data-color");
        //定義color為點選到的顏色
        $('#color').val(color);
    })

    $(function(){

        var valueElement = $('#qty');
        function incrementValue(e){
            //get now value
            var now_number = $('#qty').val();
            //add increment value
            var new_number = Math.max(parseInt(now_number) + e.data.increment, 0);
            $('#qty').val(new_number);
            return false;
        }

        $('#plus').bind('click', {increment: 1}, incrementValue);

        $('#minus').bind('click', {increment: -1}, incrementValue);

    });
</script>

@endsection
