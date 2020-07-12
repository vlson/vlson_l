<?php

namespace App\Admin\Controllers;

use App\Models\Blog\CosResourceModel;
use Encore\Admin\Actions\BatchRestore;
use Encore\Admin\Actions\Restore;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CosUploadController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '静态文件上传COS-后台';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CosResourceModel());

        $grid->filter(function ($filter){
            $filter->scope('trashed', '回收站')->onlyTrashed();
            $filter->like('cat_name', '分类名称');
        });

        $grid->column('id', __('Id'))->sortable();
        $grid->column('desc', __('资源描述'))->help('资源相关描述');
        $grid->column('type', __('资源类型'))->using([
            'image' => '图片',
            'css' => '样式文件',
            'js' => '脚本文件',
            'other' => '其他',
        ], '未知')->dot([
            'image' => 'danger',
            'css' => 'info',
            'js' => 'primary',
            'other' => 'success',
        ], 'warning')->sortable();
        $grid->column('url', __('静态资源路径'))->display(function($url){
            return 'https://vlson.oss-cn-beijing.aliyuncs.com/'.$url;
        });

        // 回收站恢复数据
        $grid->actions(function($actions){
            if (\request('_scope_') == 'trashed') {
                $actions->add(new Restore());
            }
        });

        // 回收站批量恢复数据
        $grid->batchActions(function ($batch) {
            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }

        });

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
        $show = new Show(CosResourceModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('desc', __('资源描述'));
        $show->field('type', __('资源描述'))->using([
            'image' => '图片',
            'css' => '样式文件',
            'js' => '脚本文件',
            'other' => '其他',
        ], '未知');;
        $show->field('url', __('静态资源路径'))->as(function ($url){
            return 'https://vlson.oss-cn-beijing.aliyuncs.com/'.$url;
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CosResourceModel());

        $form->text('desc', __('资源描述'))->required();
        $form->file('url', __('静态资源路径'));
        $form->select('type', __('资源类型'))->options([
            'image' => '图片',
            'css' => '样式文件',
            'js' => '脚本文件',
            'other' => '其他',
        ])->required();

        return $form;
    }
}
