<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

class ReplyObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(Reply $reply)
    {
        // 通知话题作者有新的评论
        $when = now()->addMinutes(10);
        $reply->status->user->notify( (new TopicReplied($reply))->delay($when) );
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
