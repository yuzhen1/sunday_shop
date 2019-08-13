<?php

namespace App\Admin\Controllers;

use App\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\GoodsModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsModel);

        $grid->column('goods_id', __('Goods id'));
        $grid->column('goods_name', __('Goods name'));
        $grid->column('goods_price', __('Goods price'));
//        $grid->column('market_price', __('Market price'));
//        $grid->column('bus_id', __('Bus id'));
        $grid->is_up('是否上架')->display(function ($is_up){
           if($is_up == 1){
               return "√";
           }else{
               return "×";
           }
        });
//        $grid->column('is_up', __('Is up'));
        $grid->column('goods_num', __('Goods num'));
        $grid->column('goods_score', __('Goods score'));
        $grid->goods_img('商品图片')->display(function($goods_img){
            return '<img width="100px;" src=/goodsimg/'.$goods_img.'>';
        });
//        $grid->column('goods_desc', __('Goods desc'));
//        $grid->column('cate_id', __('Cate id'));
//        $grid->column('brand_id', __('Brand id'));
//        $grid->column('create_time', __('Create time'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(GoodsModel::findOrFail($id));

        $show->field('goods_id', __('Goods id'));
        $show->field('goods_name', __('Goods name'));
        $show->field('goods_price', __('Goods price'));
        $show->field('market_price', __('Market price'));
        $show->field('bus_id', __('Bus id'));
        $show->field('is_up', __('Is up'));
        $show->field('goods_num', __('Goods num'));
        $show->field('goods_score', __('Goods score'));
        $show->goods_img('商品图片')->display(function($goods_img){
            return '<img width="100px;" src=/goodsimg/'.$goods_img.'>';
        });
        $show->field('goods_desc', __('Goods desc'));
        $show->field('cate_id', __('Cate id'));
        $show->field('brand_id', __('Brand id'));
        $show->field('create_time', __('Create time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsModel);

        $form->number('goods_id', __('Goods id'));
        $form->text('goods_name', __('Goods name'));
        $form->text('goods_price', __('Goods price'));
        $form->decimal('market_price', __('Market price'));
        $form->number('bus_id', __('Bus id'));
        $form->switch('is_up', __('Is up'));
        $form->number('goods_num', __('Goods num'));
        $form->number('goods_score', __('Goods score'));
        $form->text('goods_img', __('Goods img'));
        $form->text('goods_imgs', __('Goods imgs'));
        $form->textarea('goods_desc', __('Goods desc'));
        $form->number('cate_id', __('Cate id'));
        $form->number('brand_id', __('Brand id'));
        $form->number('create_time', __('Create time'));

        return $form;
    }
}
