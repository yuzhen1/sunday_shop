<?php

namespace App\Http\Controllers;

use App\CarModel;
use App\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    //购物车首页
    public function carList(){
        $carInfo = DB::table('shop_car')
                ->join('shop_goods','shop_car.goods_id','=','shop_goods.goods_id')
//                ->leftJoin('shop_business','shop_goods.bus_id','=','shop_business.bus_id')
                ->get();
//        dd($carInfo);
        return view('/car/carList',['carInfo'=>$carInfo]);
    }

    //加入购物车
    public function carAdd(){
        $goods_id = $_GET['goods_id'];
        $buy_num = 1;   //默认为1
        $where = [
            'goods_id'=>$goods_id
        ];
        $carInfo = CarModel::where($where)->first();

        if($carInfo){
            $updateInfo = [
                'buy_num'=>$carInfo['buy_num']+$buy_num
            ];
            $update_res = CarModel::where($where)->update($updateInfo);
            if($update_res) {
                echo "加入购物车成功 正在跳转至购物车页面";
                header("refresh:2,url='/carlist'");
            }else{
                echo "加入购物车失败";
                header("refresh:2,url='/show'");
            }
        }else{
            $user_id = Auth::id();
            $addInfo = [
                'goods_id'=>$goods_id,
                'user_id'=>$user_id,
                'buy_num'=>$buy_num,
                'add_time'=>time()
            ];
            $res = CarModel::insertGetId($addInfo);
            if($res) {
                echo "加入购物车成功 正在跳转至购物车页面";
                header("refresh:2,url='/carlist'");
            }else{
                echo "加入购物车失败";
                header("refresh:2,url='/show'");
            }
        }

    }

    //改变数据库
    public function changeNum(){
        $goods_id = $_POST['goods_id'];
        $buy_num = $_POST['buy_num'];
        $user_id=Auth::id();
        if($user_id==NULL){
            echo "用户未登录";die;
        }
        $carWhere=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id
        ];
        $carData=[
            'buy_num'=>$buy_num
        ];
        $res = DB::table('shop_car')->where($carWhere)->update($carData);
        if($res){
            $arr=[
                'font'=>'修改成功',
                'code'=>1
            ];
        }else{
            $arr=[
                'font'=>'修改失败',
                'code'=>2
            ];
        }
        return json_encode($arr,JSON_UNESCAPED_UNICODE);


    }

    //获取总价格
    public function getCountPrice(){
        $goods_id = $_POST['goods_id'];
        $id = explode(',',$goods_id);
        $user_id = Auth::id();
        $where=[
            'user_id'=>$user_id
        ];
        $cartInfo=CarModel::where($where)->whereIn('goods_id',$id)->get();
        $goodsInfo=GoodsModel::whereIn('goods_id',$id)->get();
        $countPrice=0;
        foreach($cartInfo as $k=>$v){
            foreach ($goodsInfo as $key=>$val){
                if($v->goods_id==$val->goods_id){
                    $countPrice = $countPrice + $v->buy_num * $val->goods_price;
                }

            }

        }
        return $countPrice;
    }


}
