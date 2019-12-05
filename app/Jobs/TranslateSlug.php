<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Status;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Status $status)
    {
        // 队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
