<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CalculateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时邮件';

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
    public function handle(User $user)
    {
        $this->info('开始生成用户');
        User::create([
            'name' => Str::random(11),
            'email' => Str::random(18).'@gmail.com',
            'password' => Hash::make('111111'),
        ]);
        $this->info('完成');
    }
}
