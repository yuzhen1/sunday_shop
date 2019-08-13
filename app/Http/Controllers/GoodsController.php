<?php

namespace App\Http\Controllers;

use App\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    //商品展示
    public function goodsShow(){
        $goodsInfo = DB::table('shop_goods')->simplePaginate(15);
        return view("goods/goodsShow",['goodsInfo'=>$goodsInfo]);
    }

    //商品详情
    public function goods_detail(){
        $user_id = Auth::id();
        if(empty($user_id)){
            echo "未登录";
            header("refresh:2,url='/login'");
            die;
        }
        $goods_id = $_GET['goods_id'];
        $where=[
            'goods_id'=>$goods_id
        ];
        $goods_detail = DB::table('shop_goods')
                ->join('shop_business','shop_goods.bus_id','=','shop_business.bus_id')
                ->where($where)
                ->first();
        return view("goods/goodsDetail",['goods_detail'=>$goods_detail]);
    }

}
