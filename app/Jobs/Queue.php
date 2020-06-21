<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


/*
 * 推送队列
 * 调用队列方法：
 * 参数为Queue要求的参数
 * 1 普通推送
 * Queue::dispatch($data);
 * 2 延迟推送
 * delay()中的参数为要延迟推送的分钟数
 * Queue::dispatch($data)->delay(now()->addMinute(480));
 *
 * */
class Queue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            echo json_encode(['code' => 200, 'msg' => json_encode($this->data)]);
        }catch (\Exception $exception) {
            echo json_encode(['code'=>0,'msg'=>$exception->getMessage()]);
        }
    }
}
