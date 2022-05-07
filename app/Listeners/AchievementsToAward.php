<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchievementsToAward
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LessonWatched  $event
     * @return void
     */
    public function handleLessonWatched($event)
    {
        $event;
    }
    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentWritten  $event
     * @return void
     */
    public function handleCommentWritten($event)
    {
        //
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(LessonWatched::class, [
            AchievementsToAward::class,
            'handleLessonWatched',
        ]);
        $events->listen(CommentWritten::class, [
            AchievementsToAward::class,
            'handleCommentWritten',
        ]);
    }
}
