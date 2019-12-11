<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TimeParticle as Particle;
use App\Http\Controllers\sendEmailController;

class TimeParticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:time-particle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '时间粒子，记录逝去的时间；提醒自己要珍惜时间';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('生成时间粒子中...');
        Particle::create();
        sendEmailController::index();
        $this->info('生成完毕');
    }
}
