<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品展示</title>
</head>
<script src="jquery-3.1.1.min.js"></script>
<body>
<table border="1">
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品图片</td>
        <td>商品价格</td>
        <td>商品详情</td>
    </tr>
    @foreach($goodsInfo as $k=>$v)
    <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td><img src="/goodsimg/{{$v->goods_img}}" alt="咋无图片" width="150px"></td>
            <td>{{$v->goods_price}}</td>
            <td class="goods_detail"><a href="/detail?goods_id={{$v->goods_id}}">点击查看详情</a></td>
    </tr>
    @endforeach

</table>
</body>
</html>

