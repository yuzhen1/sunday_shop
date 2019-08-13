<?php

namespace App\Admin\Controllers;

use App\OrderModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\OrderModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderModel);

        $grid->column('order_id', __('Order id'));
        $grid->column('order_no', __('Order no'));
        $grid->column('user_id', __('User id'));
        $grid->column('bus_id', __('Bus id'));
        $grid->column('order_amount', __('Order amount'));
        $grid->column('pay_status', __('Pay status'));
        $grid->column('order_status', __('Order status'));
        $grid->column('create_time', __('Create time'));
        $grid->column('status', __('Status'));
        $grid->column('pay_time', __('Pay time'));

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
        $show = new Show(OrderModel::findOrFail($id));

        $show->field('order_id', __('Order id'));
        $show->field('order_no', __('Order no'));
        $show->field('user_id', __('User id'));
        $show->field('bus_id', __('Bus id'));
        $show->field('order_amount', __('Order amount'));
        $show->field('pay_status', __('Pay status'));
        $show->field('order_status', __('Order status'));
        $show->field('create_time', __('Create time'));
        $show->field('status', __('Status'));
        $show->field('pay_time', __('Pay time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrderModel);

        $form->number('order_id', __('Order id'));
        $form->text('order_no', __('Order no'));
        $form->number('user_id', __('User id'));
        $form->number('bus_id', __('Bus id'));
        $form->decimal('order_amount', __('Order amount'));
        $form->switch('pay_status', __('Pay status'))->default(1);
        $form->switch('order_status', __('Order status'))->default(1);
        $form->number('create_time', __('Create time'));
        $form->switch('status', __('Status'));
        $form->number('pay_time', __('Pay time'));

        return $form;
    }
}
