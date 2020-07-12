<?php


namespace Encore\Admin\Actions;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BatchRestore extends BatchAction
{
    public $name = '批量恢复';

    public function handle(Collection $collection)
    {
        $collection->each->restore();

        return $this->response()->success('已恢复')->refresh();
    }

    public function dialog()
    {
        $this->confirm('确定从回收站恢复数据吗？');
    }
}
