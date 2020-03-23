<?php


namespace Encore\Admin\Actions;


use Illuminate\Database\Eloquent\Model;

class Restore extends RowAction
{
    public $name = '恢复';

    public function handle(Model $model)
    {
        $model->restore();

        return $this->response()->success('已恢复')->refresh();
    }

    public function dialog()
    {
        $this->confirm('确定从回收站恢复数据吗？');
    }
}
