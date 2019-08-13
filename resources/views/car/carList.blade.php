<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>购物车列表</title>
</head>
<script src="jquery-3.1.1.min.js"></script>
<body>
<table border="1">
    <tr>
        <td>全选 <input type="checkbox" class="all"></td>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品数量</td>
        <td>操作</td>
    </tr>
    @foreach($carInfo as $k=>$v)
    <tr goods_id="{{$v->goods_id}}">
        <td><input type="checkbox" class="box"></td>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_price*$v->buy_num}}</td>
        <td><button class="add">＋</button><span class="buy_num">{{$v->buy_num}}</span> <button class="lose">-</button></td>
        <td>删除该商品</td>
    </tr>
    @endforeach
</table>
合计：<span id="total">0</span><br>
<button id="gopay">去结算</button>
</body>
</html>
<script>
    $(function () {
        //点击+
        $(".add").click(function () {
            var buy_num = parseInt($(this).siblings('span').text());
            var goods_id = $(this).parents("tr").attr('goods_id');
            buy_num = buy_num + 1;
            $(this).siblings('span').text(buy_num);
            //改变数据库数量
            $.post(
                "/changeNum",
                {goods_id:goods_id,buy_num:buy_num},
                function(res){
                    window.location.reload();
                },
                'json'
            );
        });
        //点击-
        $(".lose").click(function () {
            var buy_num = parseInt($(this).siblings('span').text());
            var goods_id = $(this).parents("tr").attr('goods_id');
            if(buy_num<=1){
                $(this).siblings('span').text(1);
                alert("不能再减了");
            }else{
                buy_num = buy_num - 1;
                $(this).siblings('span').text(buy_num);
            }
            //改变数据库
            $.post(
                "/changeNum",
                {goods_id:goods_id,buy_num:buy_num},
                function(res){
                    window.location.reload();
                },
                'json'
            );
        });

        //点击全选
        $(".all").click(function () {
            if($(this).prop("checked")==true){
                $('.box').each(function () {
                        $(this).prop("checked",true);
                        totalPrice();
                })
            }else if($(this).prop("checked")==false){
                $('.box').each(function () {
                    $(this).prop("checked",false);
                    totalPrice();
                })
            }
        });

        //点击单个复选框
        $(".box").click(function () {
            totalPrice();
        });

        //总金额
        function totalPrice() {
            var box = $(".box");
            var goods_id = '';
            box.each(function(index){
                if($(this).prop('checked')==true){
                    goods_id += $(this).parents("tr").attr('goods_id')+',';
                }
            });
            var goods_id = goods_id.substr(0,goods_id.length-1);
            $.post(
                "/getCountPrice",
                {goods_id:goods_id},
                function(res){
                    $("#total").text(res);
                }
            )
        }

        //点击结算
        $('#gopay').click(function () {
            var box = $('.box');
            var goods_id = '';
            box.each(function(index){
                if($(this).prop('checked')==true){
                    goods_id += $(this).parents("tr").attr('goods_id')+',';
                }
            });
            var goods_id = goods_id.substr(0,goods_id.length-1);
            if(goods_id==''){
                alert("请选择一个商品进行结算");
                return false;
            }
            location.href="/orderadd?goods_id="+goods_id;
        })

    })
</script>
