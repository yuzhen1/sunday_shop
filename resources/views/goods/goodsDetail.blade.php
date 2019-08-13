<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品详情</title>
</head>
<script src="jquery-3.1.1.min.js"></script>
<body>
<table border="1">
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商家名称</td>
        <td>商品图片</td>
        <td>商品价格</td>
        <td>商品详情</td>
    </tr>
    <tr>
            <td>{{$goods_detail->goods_id}}</td>
            <td>{{$goods_detail->goods_name}}</td>
            <td>{{$goods_detail->bus_name}}</td>
{{--            <td>{{$goods_detail->goods_img}}</td>--}}
            <td><img src="/goodsimg/{{$goods_detail->goods_img}}" alt="咋无图片" width="150px"></td>
            <td>{{$goods_detail->goods_price}}</td>
            <td width="400px;">{{$goods_detail->goods_desc}}</td>
            <td><a href="/caradd?goods_id={{$goods_detail->goods_id}}">加入购物车</a></td>
    </tr>

</table>
</body>
</html>
