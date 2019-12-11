<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Auth;
use Redis;
use Carbon\Carbon;

class sendEmailController extends Controller
{
    //缓存相关
    protected $hash_prefix = 'twitter_mail_';
    protected $field_prefix = 'user_';

    protected function sendEmailTo($user)
    {
        $view = 'emails.email';
        $data = compact('user');
        $to = $user->email;
        $subject = '这是一封邮件 for you';

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function index()
    {
        // 获取今天的日期
        $date = Carbon::now()->toDateString();

        // Redis 哈希表的命名
        $hash = $this->hash_prefix . $date;

        // 字段名称
        $field = $this->field_prefix . Auth::user()->id;

        $check = Redis::hMGet($hash, array($field));

        if ( (int) $check[0] < 10) {
            Redis::hIncrBy($hash, $field, 1);
            $this->sendEmailTo(Auth::user());
        }
//        Redis::hDel($hash, $field);
//        dd(Redis::hGetAll($hash));
    }
}
