<?php

namespace App\Admin\Controllers;

use App\Good;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class GoodController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('拼团');
            $content->description('商品列表');
            $content->row('<form><input style="width: 160px" id="start_time" name="start_time" value="" class="form-control start_time" placeholder="Input 开始时间" type="text"></form>');
            $content->body($this->grid());

        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Good::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->goods_name("商品名称");
            $grid->stock_number("库存数量");
            $grid->active_price("拼团价格");
            $grid->single_price("单独购买价格");
            $grid->active_man_number("拼团人数");
            $grid->start_time("开始时间");
            $grid->end_time("结束时间");
            $grid->active_valid_hours("有效时间");
            $grid->can_active_number("可开团数量");
            $grid->picture("封面")->image('http://blog.example/uploads/',100,100);
            $grid->sort("排序")->editable();
            $grid->status("状态")->radio([
                1=>'未启用',
                2=>'已启用'
            ]);

            $grid->created_at("创建时间");
            $grid->updated_at("更新时间");
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Good::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('goods_name','商品名称');
            $form->textarea("description",'商品描述');
            $form->number('stock_number','库存数量');
            $form->text('active_price','拼团价格');
            $form->text('single_price','单独购买价格');
            $form->number('active_man_number','拼团人数');
            $form->datetime('start_time','开始时间');
            $form->datetime('end_time','结束时间');
            $form->number("active_valid_hours",'有效时间');
            $form->number('can_active_number','可开团数量');
            $form->image('picture','封面');
            $form->multipleImage('pictures','详情轮播图')->removable();
            $form->editor("content",'内容');
            $form->number('sort');
            $form->radio('status','状态')->options([1=>'禁用',2=>'启用'])->default(1);
        });
    }
}
