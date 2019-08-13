<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>订单页</title>
</head>
<body>
<h1>订单页</h1>
<table>
    <ul>
        @foreach($orderInfo as $k=>$v)
            <li>订单编号:{{$v->order_no}}</li>
            <li>订单创建时间：{{date('Y-m-d H:i:s',$v->create_time)}}</li>
            <li>订单总金额：{{$v->order_amount}}</li>
            <li><a href="/pay?order_no={{$v->order_no}}">点击去支付</a></li>
        @endforeach
    </ul>
    <a href="">返回购物车页面🛒</a>


</table>
</body>
</html>