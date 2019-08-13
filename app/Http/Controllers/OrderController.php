<?php

namespace App\Http\Controllers;

use App\OrderDetailModel;
use App\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //创建订单
    public function order_create(){
        $goods_id = $_GET['goods_id'];
        $user_id = Auth::id();
        //判断是否登录
        if(empty($user_id)){
            echo "请先登录";
        }
        //判断是否选择了商品
        if(empty($goods_id)){
            echo "请至少选择一件商品进行结算";
        }
        //处理goods_id
        $id = explode(',',$goods_id);
        $goodsInfo = DB::table('shop_car')
                ->join('shop_goods','shop_goods.goods_id','=','shop_car.goods_id')
                ->leftJoin('shop_business','shop_goods.bus_id','=','shop_business.bus_id')
                ->where(['is_up'=>1])
                ->whereIn('shop_car.goods_id',$id)
                ->get();
//        dd($goodsInfo);
        $countPrice = 0;
        foreach($goodsInfo as $k=>$v){
            $countPrice += $v->goods_price * $v->buy_num;
        }
        //订单号
        $order_no = time().rand(111111,999999);
        //加入订单表
        $data=[
            'order_no'=>$order_no,
            'user_id'=>Auth::id(),
            'bus_id'=>$v->bus_id,
            'order_amount'=>$countPrice,
            'create_time'=>time(),
        ];
       $order_id = OrderModel::insertGetId($data);
       //加入订单详情
        foreach ($goodsInfo as $k=>$v){
            $detail_data = [
                'order_id'=>$order_id,
                'user_id'=>$user_id,
                'bus_id'=>$v->bus_id,
                'goods_id'=>$v->goods_id,
                'buy_num'=>$v->buy_num,
                'goods_price'=>$v->goods_price,
                'goods_name'=>$v->goods_name,
                'goods_img'=>$v->goods_img,
                'create_time'=>time()
            ];
            OrderDetailModel::insert($detail_data);
        }
        echo "创建订单成功，正在跳转";
        header("refresh:2,url='/orderlist'");
    }

    //订单列表
    public function orderlist(){
        $where=[
            'user_id'=>Auth::id()
        ];
        $orderInfo =DB::table('shop_order')->where($where)->get()->toArray();
//        dd($orderInfo[0]['order_no']);
        return view('/order/orderlist',['orderInfo'=>$orderInfo]);
    }
}
